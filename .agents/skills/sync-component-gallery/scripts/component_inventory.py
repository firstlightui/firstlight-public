#!/usr/bin/env python3

"""Build a Firstlight component inventory through GitHub CLI and audit homepage cards."""

from __future__ import annotations

import argparse
from collections import Counter
import json
from pathlib import Path
import posixpath
import re
import subprocess
import sys
from typing import Any
from urllib.parse import quote


SCREENSHOT_SLOTS = (
    ("ios", "light"),
    ("ios", "dark"),
    ("android", "light"),
    ("android", "dark"),
)


def parse_arguments() -> argparse.Namespace:
    parser = argparse.ArgumentParser(
        description="Inventory public Firstlight component docs and audit homepage card markers.",
    )
    parser.add_argument("--repo", default="firstlightui/nativephp")
    parser.add_argument("--branch", default="main")
    parser.add_argument("--docs-root", default="docs")
    parser.add_argument("--homepage", type=Path)
    parser.add_argument(
        "--check",
        action="store_true",
        help="Exit non-zero when cards, index entries, or screenshot evidence are incomplete.",
    )

    return parser.parse_args()


def gh_api(endpoint: str, *, raw: bool = False) -> str:
    command = ["gh", "api", endpoint]

    if raw:
        command.extend(["-H", "Accept: application/vnd.github.raw+json"])

    try:
        result = subprocess.run(command, check=True, capture_output=True, text=True)
    except FileNotFoundError:
        raise SystemExit("GitHub CLI is required. Install gh and authenticate before running this skill.")
    except subprocess.CalledProcessError as exception:
        message = exception.stderr.strip() or exception.stdout.strip() or "GitHub API request failed."
        raise SystemExit(message)

    return result.stdout


def contents_endpoint(repository: str, path: str, branch: str) -> str:
    return f"repos/{repository}/contents/{quote(path, safe='/')}?ref={quote(branch, safe='')}"


def front_matter(markdown: str) -> dict[str, str]:
    match = re.match(r"\A---\s*\n(?P<body>.*?)\n---\s*(?:\n|\Z)", markdown, re.DOTALL)

    if match is None:
        return {}

    fields: dict[str, str] = {}

    for line in match.group("body").splitlines():
        if ":" not in line:
            continue

        key, value = line.split(":", 1)

        if key in {"title", "description"}:
            fields[key] = value.strip().strip("\"'")

    return fields


def markdown_body(markdown: str) -> str:
    return re.sub(r"\A---\s*\n.*?\n---\s*(?:\n|\Z)", "", markdown, count=1, flags=re.DOTALL)


def first_paragraph(markdown: str) -> str:
    body = markdown_body(markdown)
    heading = re.search(r"^#\s+.+$", body, re.MULTILINE)
    remainder = body[heading.end() :] if heading else body
    lines: list[str] = []

    for line in remainder.splitlines():
        stripped = line.strip()

        if not stripped:
            if lines:
                break

            continue

        if stripped.startswith(("#", "```", "|")):
            break

        lines.append(stripped)

    paragraph = " ".join(lines)
    paragraph = re.sub(r"\[([^]]+)]\([^)]+\)", r"\1", paragraph)
    paragraph = paragraph.replace("`", "")

    return paragraph


def index_component_links(markdown: str, components_root: str) -> list[dict[str, str]]:
    links: list[dict[str, str]] = []
    index_directory = posixpath.dirname(components_root)

    for match in re.finditer(r"\[([^]]+)]\(([^)\s]+)\)", markdown):
        target = match.group(2).split("#", 1)[0].removeprefix("./")
        resolved_path = posixpath.normpath(posixpath.join(index_directory, target))

        if not resolved_path.startswith(f"{components_root}/") or not resolved_path.endswith(".md"):
            continue

        links.append({"title": match.group(1), "path": resolved_path})

    return links


def component_screenshots(markdown: str, document_path: str, repository: str, branch: str) -> dict[str, dict[str, dict[str, str]]]:
    screenshots: dict[str, dict[str, dict[str, str]]] = {}

    for match in re.finditer(r"!\[([^]]*)]\(([^)\s]+)\)", markdown):
        target = match.group(2).split("#", 1)[0]
        resolved_path = posixpath.normpath(posixpath.join(posixpath.dirname(document_path), target))
        filename = posixpath.basename(resolved_path)
        slot = re.fullmatch(r"(ios|android)-(light|dark)\.(?:png|jpe?g|webp)", filename, re.IGNORECASE)

        if slot is None:
            continue

        platform, scheme = (value.lower() for value in slot.groups())
        screenshots.setdefault(platform, {})[scheme] = {
            "alt": match.group(1),
            "path": resolved_path,
            "url": f"https://raw.githubusercontent.com/{repository}/{branch}/{resolved_path}",
        }

    return screenshots


def homepage_audit(homepage: Path | None, component_slugs: list[str]) -> dict[str, Any] | None:
    if homepage is None:
        return None

    if not homepage.is_file():
        raise SystemExit(f"Homepage file not found: {homepage}")

    source = homepage.read_text()
    markers = re.findall(r'data-component-card=["\']([^"\']+)["\']', source)

    if not markers:
        markers = re.findall(r"['\"]slug['\"]\s*=>\s*['\"]([a-z0-9-]+)['\"]", source)

    mocked_section = re.search(
        r"['\"]mocked_components['\"]\s*=>\s*\[(?P<components>.*?)]",
        source,
        re.DOTALL,
    )
    mocked_components = (
        re.findall(r"['\"]([a-z0-9-]+)['\"]", mocked_section.group("components"))
        if mocked_section
        else []
    )
    counts = Counter(markers)
    documented = set(component_slugs)
    rendered = set(markers)

    return {
        "path": str(homepage),
        "cards": markers,
        "missing": sorted(documented - rendered),
        "stale": sorted(rendered - documented),
        "duplicates": sorted(slug for slug, count in counts.items() if count > 1),
        "mocked_components": sorted(set(mocked_components)),
        "complete": documented == rendered and all(count == 1 for count in counts.values()),
    }


def inventory(arguments: argparse.Namespace) -> dict[str, Any]:
    components_root = f"{arguments.docs_root.strip('/')}/components"
    index_path = f"{arguments.docs_root.strip('/')}/index.md"
    index_markdown = gh_api(contents_endpoint(arguments.repo, index_path, arguments.branch), raw=True)
    tree = json.loads(
        gh_api(f"repos/{arguments.repo}/git/trees/{quote(arguments.branch, safe='')}?recursive=1")
    )
    repository_files = {
        entry["path"]
        for entry in tree.get("tree", [])
        if entry.get("type") == "blob" and isinstance(entry.get("path"), str)
    }
    index_links = index_component_links(index_markdown, components_root)
    index_by_path = {link["path"]: link for link in index_links}
    index_order = {link["path"]: position for position, link in enumerate(index_links)}
    entries = json.loads(gh_api(contents_endpoint(arguments.repo, components_root, arguments.branch)))
    document_paths = sorted(
        entry["path"]
        for entry in entries
        if entry.get("type") == "file" and entry.get("name", "").endswith(".md")
    )
    document_paths.sort(key=lambda path: (index_order.get(path, len(index_order)), path))
    components: list[dict[str, Any]] = []
    evidence_gaps: list[dict[str, Any]] = []

    for path in document_paths:
        markdown = gh_api(contents_endpoint(arguments.repo, path, arguments.branch), raw=True)
        metadata = front_matter(markdown)
        slug = Path(path).stem
        screenshots = component_screenshots(markdown, path, arguments.repo, arguments.branch)
        missing_screenshots = [
            f"{platform}-{scheme}"
            for platform, scheme in SCREENSHOT_SLOTS
            if scheme not in screenshots.get(platform, {})
            or screenshots[platform][scheme]["path"] not in repository_files
        ]
        tag_match = re.search(r"<firstlight:([a-z0-9-]+)", markdown)

        if missing_screenshots:
            evidence_gaps.append({"slug": slug, "missing_screenshots": missing_screenshots})

        components.append(
            {
                "slug": slug,
                "title": index_by_path.get(path, {}).get("title") or metadata.get("title") or slug.replace("-", " ").title(),
                "page_title": metadata.get("title"),
                "description": metadata.get("description"),
                "summary": first_paragraph(markdown),
                "tag": f"firstlight:{tag_match.group(1) if tag_match else slug}",
                "docs_path": path,
                "docs_url": f"https://github.com/{arguments.repo}/blob/{arguments.branch}/{path}",
                "screenshots": screenshots,
                "listed_in_index": path in index_by_path,
            }
        )

    component_slugs = [component["slug"] for component in components]

    return {
        "repository": arguments.repo,
        "branch": arguments.branch,
        "component_count": len(components),
        "components": components,
        "unlisted_in_index": [component["slug"] for component in components if not component["listed_in_index"]],
        "evidence_gaps": evidence_gaps,
        "homepage": homepage_audit(arguments.homepage, component_slugs),
    }


def is_clean(result: dict[str, Any]) -> bool:
    homepage = result["homepage"]
    mocked_components = set(homepage["mocked_components"] if homepage else [])
    unhandled_evidence_gaps = [
        gap for gap in result["evidence_gaps"] if gap["slug"] not in mocked_components
    ]

    return (
        not result["unlisted_in_index"]
        and not unhandled_evidence_gaps
        and (homepage is None or homepage["complete"])
    )


def main() -> int:
    arguments = parse_arguments()
    result = inventory(arguments)
    print(json.dumps(result, indent=2))

    return 1 if arguments.check and not is_clean(result) else 0


if __name__ == "__main__":
    sys.exit(main())
