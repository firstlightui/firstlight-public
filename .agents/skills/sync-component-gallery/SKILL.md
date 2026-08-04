---
name: sync-component-gallery
description: Audit and synchronize Firstlight's landing-page component carousel and full component index with the current component documentation in firstlightui/nativephp. Use when adding, removing, refreshing, reconciling, or verifying component showcases after GitHub component docs or screenshots change, or when asked whether every documented Firstlight component appears on the public site.
---

# Sync Component Gallery

Keep the checked-in homepage showcase aligned with the public component docs. Use GitHub only during the workflow; do not make the production homepage depend on a live GitHub response.

## Source contract

- Treat every Markdown file in `firstlightui/nativephp:docs/components/` as a component.
- Use `docs/index.md` for canonical public order and short labels. Report component files missing from that index.
- Read the component page for its front-matter description, first explanatory paragraph, Blade tag, and screenshots.
- Expect paired `ios` and `android` screenshots in `light` and `dark`. Verify each file exists in GitHub's tree; a Markdown image link alone is not evidence.
- Represent every component once in the landing carousel with `data-component-card="<slug>"` and once on `/components` with `data-component-index-card="<slug>"`.

## Workflow

1. Read the site's `AGENTS.md` and `.impeccable.md`. Activate the repository's frontend-design, Tailwind, Laravel, and Pest skills when their domains are touched.
2. Confirm `gh auth status` succeeds. Use `gh api`; do not scrape GitHub HTML.
3. From the site root, collect the remote inventory and local audit:

   ```bash
   python3 .agents/skills/sync-component-gallery/scripts/component_inventory.py \
       --homepage resources/views/welcome.blade.php
   ```

4. Compare `components`, `homepage.missing`, `homepage.stale`, `homepage.duplicates`, `unlisted_in_index`, and `evidence_gaps` in the JSON output.
5. Inspect the current diff and preserve user-authored changes. Add missing cards. Remove stale cards only after verifying the component was intentionally removed upstream.
6. Prefer a checked-in `config/component-gallery.php` manifest plus a reusable Blade gallery-card component once more than one card exists. Keep copy and screenshot URLs traceable to the inventory; do not duplicate large card markup. When the manifest exists, pass it as `--homepage config/component-gallery.php`; the audit accepts its static `slug` fields.
7. Keep one component per landing-page carousel slide. Add every component to the separate `/components` index using intentional medium/wide cards. Link both representations to the internal `docs.show` route.
8. Rerun the inventory with `--check`. Do not finish while it reports a mismatch or unhandled evidence gap. If the user accepts a purpose-built mock, list its slug under `mocked_components` in the gallery manifest; keep the upstream gap visible in the report.

## Gallery treatment

- Make the landing-page carousel scroll through components, not through screenshots within each component. Provide previous/next controls, a current/total counter, touch scrolling, and Left/Right keyboard navigation. Never auto-advance.
- Give each landing slide one large, static, art-directed composition. Pair contained iOS and Android evidence without thick device borders, crop-based magnification, or hover zoom.
- When source evidence is missing, create a faithful purpose-built mock, label it as illustrated evidence in the UI, and do not claim unsupported behaviour.
- Preserve editorial rhythm on the `/components` index with intentional medium and wide cards. Avoid a uniform dashboard grid and keep hierarchy configurable in checked-in data.
- Include platform captions, useful alt text, keyboard-visible focus, touch-safe targets, reduced-motion support, and no horizontal page overflow.
- Keep cards concise: component name, short value statement, Blade tag, availability, evidence gallery, and docs link. The docs page owns the full API.

## Verification

Run the checks appropriate to the changed files:

```bash
python3 .agents/skills/sync-component-gallery/scripts/component_inventory.py \
    --homepage config/component-gallery.php \
    --check
vendor/bin/pint --dirty --format agent
npm run build
php artisan test --compact
```

Visually verify the landing carousel and `/components` index at 375px, 768px, and a desktop width in light and dark modes. Confirm every available screenshot loads, the landing carousel moves exactly one component at a time, controls work by keyboard and touch, contained evidence is not magnified, and the browser has no console errors.

Report the remote component count, added/updated/removed cards, evidence gaps, checks, and whether the audit is clean.
