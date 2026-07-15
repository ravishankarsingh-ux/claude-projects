# Mom Grandridge School — WordPress Theme

A from-scratch custom WordPress theme reproducing the static site (see the
repo root) as a fully client-editable WordPress site. **Zero plugin
dependencies** — everything is built on WordPress core APIs only (no ACF,
no page builder), so it will just work on any standard WordPress install.

## Installation

1. Copy this `mom-grandridge/` folder into `wp-content/themes/` on your
   WordPress install.
2. Activate it under **Appearance → Themes**.
3. Go to **Settings → General** and set the Site Title / Tagline (used in
   the nav logo text and meta description).
4. Go to **Appearance → Customize → Site Identity** and upload the school
   logo as the Custom Logo.
5. Go to **Theme Options** (new admin menu item) and go through each tab —
   every tab already has the current site's real copy pre-filled as the
   default, so you only need to change what you want to change.
6. Add content to the four new post types in the admin sidebar:
   - **Classes** (Daycare, Pre-Primary, Primary School, Middle School — set
     the icon + age range per class in the side meta box, order them with
     the "Order" field under Page Attributes)
   - **Facilities** (the 8 facility cards)
   - **Testimonials** (parent reviews — title is the parent's name, the
     post content is the quote, side meta box has role/stars/emoji-avatar)
   - **Gallery** — set a Featured Image (required) + Title (caption) on
     each; fill in the Excerpt only for the two "feature" style cards
     (Field Trips, Hands-On Learning), leave it blank for plain photos.
7. Set a permalink structure other than Plain under **Settings →
   Permalinks** if you want clean URLs for future WordPress Pages.

### Seeding the Gallery from the existing photos

The 15 photos already used on the static site live in this repo at
`assets/gallery/` (repo root, not inside this theme folder). Upload each
one to **Gallery → Add New** on the WordPress install, matching the
captions already used on the static site — the filenames describe the
photo (e.g. `solar-system-model.jpeg`, `yoga-day.jpeg`).

## What's genuinely admin-editable

- **Custom Post Types** (add/remove/reorder from wp-admin, no code): Classes,
  Facilities, Testimonials, Gallery Photos.
- **Theme Options** (12 tabs): Hero, Marquee, About, Logo Purpose, Messages,
  Stats, Classes Intro, Facilities Intro, Testimonials Intro, Admissions CTA,
  Contact, Footer.
- **Core WordPress features**: site logo (Customizer), navigation menu
  (Appearance → Menus, location "Primary Navigation" — falls back to a
  hardcoded anchor menu if none is assigned).

## Known limitations (by design, given zero external dependencies)

- **Reordering is a numeric "Order" field**, not drag-and-drop — that's
  what WordPress core's `page-attributes` support gives you without a
  plugin. Still fully self-service for the client, just not as slick as
  drag-and-drop.
- **Contact form spam protection** is a honeypot field only (no
  reCAPTCHA/Akismet, both of which are external services/plugins).
- **`wp_mail()` delivery** depends on the hosting server's mail
  transport (sendmail/SMTP) — this can't be verified until the theme is
  actually installed somewhere with real mail sending configured. Failures
  are logged via the `wp_mail_failed` hook to the PHP error log.
- **No `screenshot.png`** is included — WordPress shows a generic
  placeholder in Appearance → Themes until one is added (1200×900px PNG).

## How this was verified

This theme was built and verified in a sandboxed environment with no
network access to wordpress.org and no MySQL/WordPress install available.
What *was* verified here:

- `php -l` (syntax check) on all 29 PHP files — zero errors.
- An offline stub harness (not included in this folder — it lived in the
  build environment only) that faked WordPress's core functions well
  enough to actually `require` every file, fire every registered hook,
  render the Theme Options page for all 12 tabs, render every custom
  post type's meta box, render the full front page through all 12
  template-parts, and exercise the contact form handler's valid/invalid/
  honeypot code paths — all with zero fatal errors.

**What this does *not* verify**: that WordPress itself accepts these
files without conflicts, that the admin UI looks/behaves correctly, or
that `wp_mail()` actually delivers email. Please do a real smoke test —
install it, click through every wp-admin screen once, submit the contact
form and confirm the email arrives — before handing this off to the
client.
