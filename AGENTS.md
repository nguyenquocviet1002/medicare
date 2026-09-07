# AGENTS.md

Monorepo for the Medicare Clinic website. Contains a static HTML/CSS/JS reference site (root) and a WordPress theme (`medicare-theme/`). No build tooling, package manager, test runner, or git repo. No lint/verify step exists.

## Static Reference Site (root)

- `assets/sass/style.scss` — global sheet: design tokens (CSS custom properties in `:root`), `_normalize.scss` partial (`@use "normalize"`), `.container` grid. Output: `assets/sass/style.min.css`.
- `header/` `footer/` `Home/` `dich-vu-buoi-le/` `dich-vu-lieu-trinh/` `cfu-eliffe/` `combo/` `san-pham/` `cart/` — standalone static HTML pages, each with own `sass/style.scss` and inline JS (some render content from JS data objects).

## WordPress Theme (`medicare-theme/`)

Theme slug `medicare-clinic`. Content driven by custom post types + ACF (ACF fields registered in PHP, no ACF UI requirement). Cart uses localStorage (no WooCommerce).

**Layout:**
- `functions.php` — bootstraps all `/inc` modules; constants `MEDICARE_THEME_VERSION`, `MEDICARE_THEME_DIR`, `MEDICARE_THEME_URI`.
- `inc/` — `theme-setup.php`, `enqueue.php` (conditional per-page CSS/JS), `helpers.php` (`medicare_format_price`, logos, contact/social options), `custom-post-types.php` (5 CPTs: service, treatment, cfu_treatment, combo, product + taxonomies), `acf-fields.php` (ACF field groups via `acf_add_local_field_group`), `walker-nav-menu.php` (mega-menu + footer walkers).
- Page templates: `front-page.php` (+ `template-parts/content-{hero,about,why-choose,services,results,journey}.php`), `page-{dich-vu-buoi-le,dich-vu-lieu-trinh,cfu-eliffe,combo,san-pham,gio-hang}.php`, plus fallbacks `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`, `index.php`.
- `assets/css/` — per-page compiled CSS (`global`, `header`, `footer`, `home`, `buoi-le`, `lieu-trinh`, `cfu`, `combo`, `san-pham`, `cart` `.min.css`). Sources live in `assets/sass/`.
- `assets/js/` — `header.js`, `cart.js` (`window.Cart` API, listens for `[data-cart-id]`/`[data-cart-name]`/`[data-cart-price]` buttons), `scroll-reveal.js`, `tabs.js` (`[data-tabs]`/`[data-tab-*]` + hash switching e.g. `#meso`), hero/about/services/results/compare/journey slider modules.
- `assets/images/` — subfolders per page (`Home`, `header`, `footer`, `dich-vu-buoi-le`, `dich-vu-lieu-trinh`, `cfu`, `combo`, `san-pham`).

**CPT content strategy:** Every page template first queries its CPT (service/treatment/cfu_treatment/combo/product). If no posts exist, it renders a static fallback mirroring the reference HTML (same BEM classes, image srcs prefixed `MEDICARE_THEME_URI . '/assets/images/<page>/'`). CPT grouping: buoi-le via `section` ACF field or `service_category`; lieu-trinh via `treatment_category`; cfu via `section` ACF field; san-pham via `product_category` taxonomy tabs + `sub_category` ACF; combo via `combo_type`/section.

## Build & Style Rules

- Never edit `*.min.css` — regenerate from `.scss` with the Sass CLI (compressed): `sass --style=compressed assets/sass/<name>/style.scss assets/css/<name>.min.css`. Sass CLI available at `C:\Users\admin\AppData\Roaming\npm\sass`.
- No hardcoded colors/fonts — use tokens `var(--color-*)`, `var(--font-sans)` from the global SCSS. BEM naming: `.block__element--modifier`.
- Custom breakpoints: `992px` desktop nav, `991.98px` mobile drawer, `575.98px` small mobile, `1400px` wide spacing.
- Order matters in `<head>`: global CSS first, then component/page CSS.
- UI text, comments, CPT labels are Vietnamese; keep new content consistent.
- Use `esc_html/get_field(..., ID)`/`esc_url` and guard ACF with `function_exists('get_field')`. PHP on this machine may not be on PATH; use `php -l` after changes if available.
- PHP lint: the reference static site has no PHP; theme files should be validated with `php -l` (php may need to be installed/portable).