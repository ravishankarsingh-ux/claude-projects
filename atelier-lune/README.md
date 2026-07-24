# Atelier Lune — Block Theme

Custom WordPress block theme built from `atelierlune layout.html` (FW26
Phase Collection). Core Gutenberg blocks only; the layout's
`data-gutenberg` annotations were followed 1:1.

## Token mapping (layout → theme.json)

| Layout token | theme.json |
|---|---|
| `--color-ink/bone/cream/plum/brass/chalk` | `settings.color.palette` (same slugs) |
| `--color-line` | `settings.custom.line` |
| `--font-display` Fraunces | `fontFamilies.display` (variable woff2, self-hosted) |
| `--font-body` Inter | `fontFamilies.body` (variable woff2) |
| `--font-mono` IBM Plex Mono | `fontFamilies.mono` (400 + 500 woff2) |
| `--space-xs/sm/md/lg/xl` | `settings.spacing.spacingSizes` (same slugs) |
| `--max-width: 1280px` | `settings.layout.contentSize` |
| Hero `clamp()` sizes | fluid `fontSizes` (`xl`, `lg`, `quote`) |

## Custom CSS (`assets/css/signature.css`)

Only the elements the layout marks `data-gutenberg="custom-css"`:
cutting-line dividers, vertical selvedge label, hero fabric band, the six
look swatches, phase badges, palette chips, tag pill, placeholder form
styling, plus the outline button style and hover colors. Everything else
is theme.json or block attributes.

## Structure

- `parts/header.html` — sticky nav (Site Title + Navigation block)
- `parts/footer.html` — dark footer, brand + nav row, legal row
- `patterns/` — hero, manifesto, collection, process, bespoke, press,
  journal, contact ("Atelier Lune" pattern category). Section dividers
  (§ 01 / § 02) are folded into the top of manifesto/collection patterns.
- `templates/` — front-page (all eight patterns), index + archive
  (journal-card Query Loop), page, single, 404

## After activating on staging

1. **Menu** — assign nav menu on the header/footer Navigation blocks:
   Collection, Atelier, Bespoke, Journal, Contact (anchor links).
2. **Contact form** — the form in `patterns/contact.php` is placeholder
   HTML (posts nowhere). Replace the Custom HTML block with a Contact
   Form 7 / WPForms shortcode block, keep the `contact-form` class for
   styling.
3. **Look photography** — each `look-swatch` div is a stand-in; swap for
   a core Image block (keep `look-phase` badge via Cover block if
   wanted).
4. **Journal** — the front-page journal cards are static teasers; point
   them at real posts or replace with a Query Loop (index template
   already has one).
5. **Synced patterns** — convert any section reused across pages into a
   synced pattern from the editor.

## Deploy

Zip and upload (no SFTP needed):

```sh
zip -r atelier-lune.zip atelier-lune -x "*/README.md"
```

wp-admin → Appearance → Themes → Add New Theme → Upload Theme → Activate.
Staging first; push to production only after the homepage matches the
layout file pixel-for-pixel.
