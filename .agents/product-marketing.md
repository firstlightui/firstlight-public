# Product Marketing Context

**Document version:** v2
**Last updated:** 2026-08-24

> ⚠️ **Stage: alpha, pre-adoption.** No users, installs, testimonials, or sales conversations yet. Sections drawn from the codebase are marked as such; anything still unanswered is marked **[NEEDS INPUT]**. Objections and switching dynamics are *hypothesised* — they have not been validated against a real developer.

## Product Overview
**One-liner:** A curated form and control layer for NativePHP Mobile UI that brings Laravel `validate()`, `submit()`, and Gate-backed `authorize()` to native mobile screens.

**What it does:** Firstlight UI is a Composer package (`firstlightui/nativephp`) that installs alongside NativePHP Mobile UI. You author screens with familiar Blade tags (`<firstlight:segmented />`, `<firstlight:text-field />`), and they render as genuine SwiftUI on iOS and Jetpack Compose on Android through NativePHP's EDGE element tree. Beyond wrapping controls, it adds three PHP concerns NativePHP does not ship — `ValidatesFields`, `SubmitsForms`, and `AuthorizesActions` — so Laravel validation messages land on native field error slots, submits run once and publish native Feedback, and Gate/Policy decisions hide or disable native actions instead of throwing to the generic error overlay.

**Product category:** Mobile UI component library for NativePHP / Laravel — the "shelf" is *NativePHP UI packages*, adjacent to Blade component libraries (Flux, Livewire UI kits) but for native mobile output rather than HTML.

**Product type:** Open-source developer package (Composer), with a marketing + documentation + component-gallery website. Docs are sourced live from the `firstlightui/nativephp` GitHub repo.

**Business model:** Open source and free. If adoption reaches a meaningful level, premium features may follow — app shells, layouts, and similar higher-level building blocks — but nothing is committed. Treat Firstlight as free OSS in all messaging; do not tease or imply a paid tier.

**Pricing:** Free. No paid tier exists.

**Stage:** Alpha. Pre-adoption, no public users yet.

## Target Audience
**Target companies:** Laravel shops and solo/indie Laravel developers building mobile apps — teams who already run Laravel in production and want to ship iOS/Android without hiring Swift/Kotlin engineers or adopting a JS mobile stack. Likely agency, SaaS, and internal-tools teams; small to mid-size.

**Decision-makers:** The developer is the decision-maker. Laravel backend/full-stack developers, tech leads, and agency principals choosing a mobile approach. Little to no procurement involvement.

**Primary use case:** Building forms and interactive screens in a NativePHP Mobile app without re-solving validation, submission, and authorization semantics in every app.

**Jobs to be done:**
- "Let me build a native mobile app using only the Laravel skills I already have."
- "Give me native form behaviour — errors on fields, guarded submits, permission-aware actions — that I'd otherwise hand-roll per screen."
- "Prove the output is really native (SwiftUI / Material 3), not a webview imitation."

**Use cases:**
- Native forms: text fields, text areas, selects, date/time pickers, sliders, steppers, switches, checkboxes with server-authoritative state.
- Guarded actions: submit-once buttons that validate, run a PHP action, and surface success feedback.
- Permission-aware UI: hide or disable native controls based on Laravel Gates and Policies.
- Selection and navigation surfaces: segmented controls, choice groups, pill groups, lists, list sections, modals, bottom sheets.
- Status and feedback: badges, callouts, progress, activity indicators, transient app-level Feedback that survives navigation.

## Personas
Single-persona developer product; the table below is a best guess and mostly collapses into one role.

| Persona | Cares about | Challenge | Value we promise |
|---------|-------------|-----------|------------------|
| Laravel developer (user + champion + decision maker) | Staying in Blade/PHP; not learning a parallel state model | NativePHP gives primitives but no form contracts | `validate()`, `submit()`, `authorize()` on native screens |
| Tech lead / agency principal | Consistency across screens and apps; maintainability | Every dev solves field errors and double-submits differently | One decided contract, reused everywhere |
| Skeptic evaluating "is this really native?" | Platform fidelity, accessibility, look-and-feel | Cross-platform tools usually approximate native | Real SwiftUI + Compose, per-platform screenshots as evidence |

## Problems & Pain Points
**Core problem:** NativePHP publishes a native element tree, but stops short of Laravel's form ergonomics. There is no screen-level `validate()`, no once-run `submit()` helper, and no Gate-backed action guard. Developers rebuild those three things by hand on every screen, inconsistently.

**Why alternatives fall short:**
- **NativePHP Mobile UI alone** — comprehensive native foundation, but leaves validation, submit guarding, and authorization to each app. `@nativeError` is sibling text, not a bound field error slot; a thrown `ValidationException` hits the generic overlay.
- **React Native / Flutter** — genuinely native-ish output, but abandons Laravel and Blade entirely; a second language, second toolchain, second team.
- **Webview / hybrid wrappers** — keeps PHP, but the result never feels native and platform conventions leak.

**What it costs them:** Repeated per-screen plumbing; inconsistent error and permission behaviour across a codebase; double-submit bugs; unauthorized mutations falling through to a generic error overlay instead of a designed state.

**Emotional tension:** [NEEDS INPUT — inferred] Wanting to ship mobile without leaving the ecosystem they're productive in, plus doubt that a PHP-driven mobile app can look and feel genuinely native.

## Competitive Landscape
**Direct:** NativePHP Mobile UI's own component set — the base layer Firstlight builds on rather than replaces. Falls short by design: broad native coverage, but no opinionated form/action contracts and no PHP validation/authorization helpers.

**Secondary:** React Native, Flutter, Expo — solve "native mobile app" but require leaving Laravel/PHP for the UI layer entirely.

**Indirect:** Responsive web app / PWA, or Livewire-in-a-webview — keeps the Laravel workflow but gives up native controls, platform conventions, and app-store-grade feel.

**Note on the slot:** As far as we know, Firstlight is currently the only curated form/control layer built on NativePHP Mobile UI. There is no direct competitor in that position — the real competition is "do nothing and hand-roll it per screen," or leave the ecosystem for React Native / Flutter.

## Differentiation
**Key differentiators:**
- Laravel `validate()`, `submit()`, and `authorize()` on native screens — explicitly what NativePHP EDGE does not ship.
- Validation messages bound to the *native* field error slot, not sibling text or a generic overlay.
- Curated, opinionated catalogue (27 components) rather than exhaustive coverage — one decided contract per problem.
- Built on Mobile UI's ordinary extension points, inheriting its semantic theme, EDGE, element tree, renderer, and event lifecycle. No fork, no parallel runtime.
- Per-platform, per-theme screenshot evidence (iOS/Android × light/dark) for every component.

**How we do it differently:** Rather than reimplementing the native bridge, Firstlight sits on SuperNative's foundation and adds product-level contracts. Blade compiles to a Firstlight element with stable public values → the shared element tree publishes platform-neutral intent → SwiftUI and Compose renderers express it natively. Interaction stays on the native UI thread.

**Why that's better:** Developers stay in Blade and PHP, get consistent field semantics for free, and inherit every NativePHP improvement automatically.

**Why customers choose us:** They're already committed to NativePHP and want the form layer solved once, correctly, with credible native evidence.

## Objections
**Responses approved; triggers unvalidated.** The founder has signed off on the responses below — use them as written. What is *not* yet validated is whether these are the objections developers actually raise, since the project is alpha with no users or sales conversations. Add real objections as they surface; don't rewrite these.

| Objection | Response |
|-----------|----------|
| "Why not just use NativePHP Mobile UI directly?" | You can — Firstlight complements it. Mobile UI gives you the native foundation; Firstlight decides form, validation, submit, and authorization semantics once so every screen doesn't re-solve them. |
| "Is this actually native, or an approximation?" | Real SwiftUI and Jetpack Compose via Mobile UI's own renderers, following Material 3 and Apple conventions. Every component ships iOS and Android screenshots in both themes. |
| "Another dependency to maintain — what if it's abandoned?" | It uses Mobile UI's ordinary extension points, so it inherits upstream improvements rather than forking. [NEEDS INPUT: maintainer commitment, release cadence, backing — and this objection lands harder while the project is alpha.] |
| "The catalogue is small (27 components)." | Deliberately curated. It grows only where a reusable product-level contract saves every app from solving the same problem again. |
| "It's alpha — is it safe to build on?" | [NEEDS INPUT] Be honest about the stage. Decide the line: what's stable, what may change, and what early adopters get in return. |

**Anti-persona:** Teams not on Laravel/PHP; teams needing exhaustive component coverage or heavy custom visual design (Firstlight follows platform semantics, not bespoke brand UI); web-only projects.

## Switching Dynamics
**Hypothesised — inferred from positioning copy, not customer research.** No interviews have been run.

**Push:** Hand-rolling the same validation/submit/permission plumbing on every NativePHP screen; inconsistent error behaviour; the generic error overlay appearing where a designed state should be.

**Pull:** Familiar `$this->validate()` and `$this->submit()` on a native screen; copyable Blade examples; `composer require firstlightui/nativephp` and you're in.

**Habit:** Already writing bespoke per-screen NativePHP code that "works fine"; comfort with NativePHP primitives alone.

**Anxiety:** Adding a layer between their app and NativePHP; will it lag upstream releases; will the curated catalogue cover what they need; is the project maintained — and, at alpha, will the API change under them.

## Customer Language
**No customer verbatims exist yet** — alpha, no users. Everything below is *our* language, taken from site copy. The first few real developer conversations should replace this section; that is the single highest-value gap in this document.

**How they describe the problem:**
- "[verbatim needed]"

**How they describe us:**
- "[verbatim needed]"

**Words to use:** native, SwiftUI, Jetpack Compose, Material 3, Blade, EDGE, element tree, stable values, field semantics, server-authoritative, contracts, curated, familiar, platform-neutral intent, Gate-backed

**Words to avoid:** webview, hybrid, cross-platform framework, imitation/mimic native, "component library" as a generic frontend term, teal (brand colour is dawn-led, not the starter-kit teal), "replaces NativePHP" (it complements)

**Glossary:**
| Term | Meaning |
|------|---------|
| NativePHP Mobile UI | The official native UI foundation Firstlight builds on |
| SuperNative | The NativePHP foundation by Shane Rosenthal and Simon Hamp that supplies the bridge |
| EDGE | NativePHP's element definition / rendering system Blade compiles into |
| Element Tree | Shared, platform-neutral representation published to native renderers |
| `ValidatesFields` | Firstlight concern adding screen-level `validate()` / `validateOnly()` |
| `SubmitsForms` | Firstlight concern adding once-run `submit()` with success Feedback |
| `AuthorizesActions` | Firstlight concern adding `allows()`, `denies()`, `authorize()` |
| Feedback | Queued native app-level messages that persist across screen navigation |
| Firstlight element | A Blade tag compiled to a native element with stable public values |

## Brand Voice
**Tone:** Technical, precise, understated. States what exists and what doesn't ("NativePHP has no `validate()`") without hype or superlatives.

**Style:** Direct and evidence-led. Short declarative sentences, code alongside claims, concrete API names over abstractions. Headlines are paired contrasts — "Native by platform. Familiar in Blade.", "NativePHP publishes a tree. Firstlight adds Laravel around it."

**Personality:** Authentic, efficient, reliable, production-minded, quietly crafted. A credible continuation of the Laravel/NativePHP ecosystem — never a separate frontend world.

## Proof Points
**No social proof yet.** Alpha, pre-adoption: no installs to cite, no stars worth citing, no named users, no testimonials. Do not manufacture or imply any. Until traction exists, proof has to come from *demonstrable artefacts* rather than adoption:

**What we can prove today:**
- 27 components, each with real iOS and Android screenshots in light and dark, generated from the source repo
- Three PHP concerns that demonstrably do not exist in NativePHP EDGE (`ValidatesFields`, `SubmitsForms`, `AuthorizesActions`) — a verifiable gap, not a claim
- Built on SuperNative by Shane Rosenthal and Simon Hamp — borrowed ecosystem credibility
- Public docs sourced live from the GitHub repo, and an `llms.txt`

**Metrics:** None yet.

**Customers:** None yet.

**Testimonials:** None yet.

**Value themes:**
| Theme | Proof |
|-------|-------|
| Genuinely native | iOS/Android × light/dark screenshots per component, straight from the source repo; SwiftUI + Compose renderers; interaction on the native UI thread |
| Familiar at the source | Blade tags, Laravel properties, NativePHP events; no parallel state model |
| Laravel contracts NativePHP lacks | `validate()`, `submit()`, `authorize()` — stated explicitly as gaps in NativePHP EDGE |
| Ecosystem credibility | Built on SuperNative by Shane Rosenthal and Simon Hamp; uses Mobile UI's ordinary extension points |
| Fast to first success | `composer require firstlightui/nativephp`, copyable Blade examples, how-to guides per concern |

## Goals
**Business goal:** [NEEDS INPUT — confirm] Inferred: reach enough adoption within the NativePHP ecosystem to establish Firstlight as the default form layer, which is also the precondition for any future premium tier (app shells, layouts). At alpha the practical goal is first real users and feedback, not revenue.

**Conversion action:** `composer require firstlightui/nativephp` (copy-to-clipboard on the landing page), with the getting-started guide as the secondary path.

**Current metrics:** None — alpha, pre-adoption.

## Changelog
*Newest first. One line per revision: what changed and why.*
- v2 (2026-08-24) — Confirmed with founder: free OSS with possible future premium (app shells, layouts) if adoption warrants; no known direct competitor in the curated-layer slot; product is alpha with zero users, so proof points reset to demonstrable artefacts and objections/switching dynamics relabelled as hypothesised.
- v1 (2026-08-24) — Initial context, auto-drafted from the marketing site, docs config, component gallery, and `.impeccable.md`. Business model, pricing, objections, customer verbatims, proof points, and goals flagged as needing input.
