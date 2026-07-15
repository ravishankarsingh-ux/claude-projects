# Mom Grandridge School — WordPress Theme

A custom WordPress theme reproducing the static site (see the repo root)
as a fully client-editable WordPress site. Content editing depends on
**Secure Custom Fields** (SCF — the wordpress.org-hosted fork of Advanced
Custom Fields; same PHP API, so the code works identically with the
original ACF plugin too) for the Home page's fields and the "Flexible
Sections" page builder. Everything else — the 4 custom post types, the
contact form, the Gallery page — is plain WordPress core with no plugin
dependency.

## Installation

1. Copy this `mom-grandridge/` folder into `wp-content/themes/` on your
   WordPress install.
2. **Install Secure Custom Fields** — **Plugins → Add New**, search
   "Secure Custom Fields", install and activate. (The original ACF plugin
   from advancedcustomfields.com works too, if you'd rather use that —
   same field-registration API either way.)
3. Activate this theme under **Appearance → Themes**.
4. Go to **Settings → General** and set the Site Title / Tagline (used in
   the nav logo text and meta description).
5. Go to **Appearance → Customize → Site Identity** and upload the school
   logo as the Custom Logo.
6. **Create the Home page and set it as your static front page** — this
   step matters more than it sounds: **Pages → Add New**, title it
   "Home", publish it, then go to **Settings → Reading**, set "Your
   homepage displays" to "A static page", and choose "Home" as the
   Homepage. All of the theme's field groups (Hero, About, Stats, etc.)
   attach to *whichever page is the site's static front page* — without
   this step there's nowhere for them to attach to, and you'll see a
   warning about it at the top of wp-admin as a reminder.
7. **Open that Home page for editing** — you'll see a stack of
   collapsible boxes below the content editor: Hero, Marquee, About,
   Logo Purpose, Messages, Stats, Classes Intro, Facilities Intro,
   Gallery Intro, Testimonials Intro, Admissions CTA, Contact, Footer.
   Every field is pre-filled with the current site's real copy as its
   default, so you only need to change what you want to change, then
   click **Update**.
8. Add content to the four custom post types in the admin sidebar:
   - **Classes** (Daycare, Pre-Primary, Primary School, Middle School — set
     the icon + age range per class in the side meta box, order them with
     the "Order" field under Page Attributes)
   - **Facilities** (the 8 facility cards)
   - **Testimonials** (parent reviews — title is the parent's name, the
     post content is the quote, side meta box has role/stars/emoji-avatar)
   - **Gallery** — set a Featured Image (required) + Title (caption) on
     each; fill in the Excerpt only for the two "feature" style cards
     (Field Trips, Hands-On Learning), leave it blank for plain photos.
9. Set a permalink structure other than Plain under **Settings →
   Permalinks** if you want clean URLs for future WordPress Pages.
10. **Set up the navigation menu** — on first activation the theme
    auto-creates a "Primary Menu" under **Appearance → Menus** with all
    8 links already in place (Home, About, Classes, Facilities, Gallery,
    Parents, Contact, Admission), assigned to the Primary Navigation
    location. Edit it there like any other WordPress menu — rename,
    reorder, add, or remove links freely. The "Admission" item has the
    `nav-cta` CSS class, which is what makes it render as the pill
    button instead of a plain link — to move that button styling to a
    different item, open **Screen Options** (top-right of the Menus
    screen), enable "CSS Classes", then move the `nav-cta` class to
    whichever item you want.
11. **Set up the Full Gallery page** (optional) — create a new Page,
    title it e.g. "Gallery", and under **Page Attributes → Template**
    choose "Full Gallery", then publish it. The home page's Gallery
    teaser section will automatically detect and link to this page once
    it exists — no need to paste a URL anywhere.

### Seeding the Gallery from the existing photos

The 15 photos already used on the static site live in this repo at
`assets/gallery/` (repo root, not inside this theme folder). Upload each
one to **Gallery → Add New** on the WordPress install, matching the
captions already used on the static site — the filenames describe the
photo (e.g. `solar-system-model.jpeg`, `yoga-day.jpeg`).

## Building other pages with "Flexible Sections"

Any page other than Home can reuse the same section designs — Hero,
About, Gallery, Testimonials, and so on — plus a plain rich-text block,
mixed and matched in any order:

1. Create a new Page (**Pages → Add New**).
2. Under **Page Attributes → Template**, choose "Flexible Sections".
3. Below the content editor you'll see a **Sections** field — click
   **Add Row**, pick a layout (Hero, About, Logo Purpose, Messages,
   Stats, Classes Intro, Facilities Intro, Gallery Intro, Testimonials
   Intro, Admissions CTA, Contact, or Rich Text), fill in its fields,
   and repeat. Drag rows by their handle to reorder them, or remove a
   row entirely.
4. Publish — the page renders exactly those sections, in that order,
   each looking identical to its Home page counterpart.

**Footer isn't in that list** — it's the sitewide footer shown at the
bottom of every page (via `footer.php`), not a per-page content section,
so it stays a Home-page-only field group and can't be added as a row
here.

## What's genuinely admin-editable

- **Custom Post Types** (add/remove/reorder from wp-admin, no code): Classes,
  Facilities, Testimonials, Gallery Photos.
- **Home page fields** (13 field groups via Secure Custom Fields, shown
  directly on the Home page's own edit screen): Hero, Marquee, About,
  Logo Purpose, Messages, Stats, Classes Intro, Facilities Intro, Gallery
  Intro, Testimonials Intro, Admissions CTA, Contact, Footer.
- **Flexible Sections** on any other page (see above) — 11 of those same
  section types (everything except Footer) plus a Rich Text block,
  addable/reorderable/removable per page.
- **Core WordPress features**: site logo (Customizer), navigation menu
  (Appearance → Menus — auto-created and assigned on activation, see step
  10 above; falls back to a hardcoded anchor menu only if the assignment
  is ever removed).

## The home page Gallery teaser vs. the Full Gallery page

The home page's horizontal-scroll Gallery section only shows the first
*N* photos (default 10, editable in the Home page's Gallery Intro field
group — "Photos shown on the home page"), ordered the same way as the
Gallery custom post type's Order field. If there are more photos than
that limit, a "View Full Gallery →" link automatically appears next to
the section heading, pointing at the Full Gallery page (see installation
step 11) — which lists every photo in a responsive grid, still opening
in the same popup lightbox. If no Full Gallery page has been created
yet, that link simply doesn't show.

## Known limitations

- **Content editing now depends on Secure Custom Fields (or ACF) staying
  installed and active.** If it's ever deactivated, the Home page's
  field values remain safely stored in the database, but the friendly
  editing UI disappears and the front end falls back to each section's
  built-in default copy (see "How this was verified" below) rather than
  showing blank content — it degrades gracefully, but you'll want SCF/ACF
  active for real editing.
- **The 4 custom post types and the contact form remain plugin-free** —
  reordering their items is still a numeric "Order" field (not
  drag-and-drop, since that's what WordPress core's `page-attributes`
  support gives you without a plugin), and the contact form's only spam
  protection is a honeypot field (no reCAPTCHA/Akismet).
- **`wp_mail()` delivery** depends on the hosting server's mail
  transport (sendmail/SMTP) — this can't be verified until the theme is
  actually installed somewhere with real mail sending configured. Failures
  are logged via the `wp_mail_failed` hook to the PHP error log.
- **No `screenshot.png`** is included — WordPress shows a generic
  placeholder in Appearance → Themes until one is added (1200×900px PNG).

## How this was verified

This theme was built and verified in a sandboxed environment with no
network access to wordpress.org and no MySQL/WordPress/SCF install
available. What *was* verified here:

- `php -l` (syntax check) on every new/changed PHP file — zero errors.
- An offline stub harness (not included in this folder — it lived in the
  build environment only) faking both WordPress core and Secure Custom
  Fields' functions (`get_field()`, `get_sub_field()`, `have_rows()`,
  `get_row_layout()`, `acf_add_local_field_group()`, etc.) confirmed:
  - `do_action('acf/init')` registers exactly 14 field groups (13 section
    groups + the "Page Sections" Flexible Content group) with exactly 13
    layouts (12 flexible sections + Rich Text) — matching the section
    registry exactly;
  - `mgs_opt()` resolves a prefixed field (e.g. `hero_badge`) against the
    Home page when called outside any row, and correctly switches to an
    unprefixed `get_sub_field()` lookup — isolated from the Home page's
    own values — while inside a simulated active Flexible Content row;
  - the full Home page renders through all 12 template-parts (13,750
    bytes) with zero fatal errors, and the new Flexible Sections template
    renders a mix of a named-section row and a Rich Text row (814 bytes,
    both rows' content present in the output) with zero fatal errors;
  - every custom post type's meta box, the Full Gallery page, `page.php`,
    and `404.php` still render correctly;
  - the contact form handler's valid/invalid/honeypot code paths are
    unaffected by this migration;
  - with every ACF/SCF function **entirely undefined** (simulating the
    plugin never being installed), `do_action('acf/init')` is a silent
    no-op, `mgs_opt()` degrades to each section's built-in default for
    every field checked, and both `front-page.php` and `page-flexible.php`
    (with no saved rows, falling back to the page's own editor content)
    still render with zero fatal errors.

**What this does *not* verify**: that WordPress and Secure Custom Fields
themselves accept these files without conflicts, that the admin UI looks
and behaves correctly, or that `wp_mail()` actually delivers email.
Please do a real smoke test — install it with SCF active, click through
every wp-admin screen once (including building a Flexible Sections page),
submit the contact form and confirm the email arrives — before handing
this off to the client.
