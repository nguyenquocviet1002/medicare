# AGENTS.md

Static HTML/CSS/JS site scaffolding (Medicare Clinic). No build tooling, package manager, test runner, or git repo. No lint/verify step exists.

## Layout

- `assets/sass/style.scss` — global sheet: design tokens (CSS custom properties in `:root`), `_normalize.scss` partial (`@use "normalize"`), `.container` grid. Output: `assets/sass/style.min.css`.
- `header/` — standalone header component: `index.html`, `js/script.js` (vanilla JS mobile drawer/backdrop/Escape-close), `sass/style.scss`. Output: `header/sass/style.min.css`.

## Rules

- Never edit `*.min.css` — generated manually from matching `.scss` source with the Sass CLI (compressed style); no compile script is committed. Edit the SCSS and regenerate.
- No hardcoded colors/fonts — use tokens `var(--color-*)`, `var(--font-sans)` from `assets/sass/style.scss`. BEM naming: `.header__element--modifier`.
- Custom breakpoints: `992px` desktop nav, `991.98px` mobile drawer, `575.98px` small mobile, `1400px` wide spacing.
- `header/index.html` loads two stylesheets: global `../assets/sass/style.min.css` then component `sass/style.min.css` (order matters — do not merge).
- UI text and comments are Vietnamese; keep new content consistent.
- Known gap: `images/logo-medicare.svg` referenced in `index.html` is missing (renders without it).