# Devadigm Block Theme

Custom WordPress **block theme** for devadigm.com — the target of the
classic-theme → block-theme conversion. Built with core Gutenberg blocks
only (Group, Columns, Heading, Paragraph, Buttons, Query Loop, Navigation,
Site Title); no Stackable blocks needed so far.

## Design principles

- **`theme.json` is the single source of truth** — palette, Inter type
  scale (fluid where the classic CSS used breakpoint jumps), 6–120px
  spacing scale, 1280px content width, button styles, and the two team
  portrait gradients all live there.
- **Repeated sections are patterns** (`patterns/`): hero, services,
  about, team, contact CTA — all registered under the "Devadigm" pattern
  category. On staging, convert the ones reused across pages (header CTA,
  contact CTA) into **synced patterns** from the editor so one edit
  updates everywhere.
- **Custom CSS only for true edge cases**
  (`assets/css/devadigm-extras.css`): the fixed particle canvas layering,
  hairline list dividers, eyebrow kicker, portrait aspect ratios, hover
  transitions. Everything else is theme.json or block attributes.
- **Self-hosted Inter** via `theme.json` `fontFace` (variable woff2,
  latin + latin-ext) — no Google Fonts request at runtime.
- The constellation canvases (`assets/js/constellation.js` +
  `motion.min.js`) are enqueued from `functions.php`; the ambient
  background canvas is injected on `wp_body_open`. The script no-ops for
  missing canvases and respects `prefers-reduced-motion`.

## Structure

```
devadigm-block-theme/
├── style.css              Theme header
├── theme.json             Global styles/settings (source of truth)
├── functions.php          Enqueues + pattern category + ambient canvas
├── templates/             front-page, index, page, single, archive, 404
├── parts/                 header, footer
├── patterns/              hero, services, about, team, cta
└── assets/
    ├── css/devadigm-extras.css   Edge-case CSS only
    ├── fonts/                    Inter variable woff2 (latin, latin-ext)
    └── js/                       constellation.js, motion.min.js
```

## Deploying to staging (Cloudways)

Never deploy to production directly — staging first, verify, then use
Cloudways' staging → production push.

Option A — upload as a zip:

```sh
cd devadigm-block-theme/.. && zip -r devadigm-block-theme.zip devadigm-block-theme \
  -x "*/README.md"
```

Then wp-admin → Appearance → Themes → Add New Theme → Upload Theme.

Option B — SFTP: upload the `devadigm-block-theme/` folder to
`applications/<app>/public_html/wp-content/themes/`.

After activating:

1. **Menus**: the Navigation block in `parts/header.html` has no menu
   assigned — open Site Editor → Header, click the Navigation block, and
   pick/create the menu (Services, About, Team, Contact anchors).
2. **Reading settings**: `front-page.html` renders the homepage
   regardless, but set Settings → Reading → static page if a real Page
   should own the homepage content.
3. **Synced patterns**: recreate the repeated CTAs as synced patterns
   from the provided theme patterns where cross-page reuse is wanted.

## Verification checklist (homepage proof of concept)

Compare staging against the original pixel-for-pixel:

- [ ] Header: logo triangle + wordmark, uppercase nav, pill CTA button
- [ ] Hero: 78px display heading (48px mobile), eyebrow, constellation canvas
- [ ] Services: 2-col, hairline dividers, 24px titles / 15px silver descriptions
- [ ] About: reversed 2-col with mini constellation
- [ ] Team: 2-up grid, 4:5 gradient portraits, iris roles
- [ ] CTA: centered, mailto button, contact line
- [ ] Footer: hairline top border, 3-part flex row
- [ ] Ambient triangle particle field behind all content
- [ ] Reduced-motion: animations disabled, content fully visible

## ⚠️ Status / known limitation

This theme was built **without access to the staging site** — the remote
build environment's network policy blocked both HTTPS to
`wordpress-698237-6574313.cloudwaysapps.com` and SFTP to `139.59.34.151`
(see repo conversion notes). Design tokens and section structure were
sourced from `devadigm-website/` in this repo. Before calling the
homepage conversion done, verify against the live classic theme and
adjust `theme.json` values where the live site differs.
