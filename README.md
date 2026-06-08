# Artfolio Studio

Artfolio Studio is a lightweight, easy-to-customize portfolio starter built with PHP, HTML, CSS, and JavaScript. It gives you card-based templates, simple PHP entry points, and an organized asset structure so you can publish an artist portfolio quickly.

Table of contents
- Overview
- Quick start
- Database (optional)
- Project structure
- Customization notes
- Deployment
- Contributing
- License & contact

Overview
--------
This project contains static templates and small PHP pages (no framework). It's intentionally minimal so you can adapt the UI, swap images, or add a backend without a heavy toolchain.

Quick start (local)
-------------------
Prerequisite: PHP installed locally (PHP 7.2+ recommended).

1. Clone the repo and open it:

```bash
git clone <your-repo-url>
cd "ARTFOLIO_END-main"
```

2. Run a local PHP server and open the site in your browser:

```bash
php -S localhost:8000
# Open: http://localhost:8000/index.php
```

3. To use search or sign features, try `sear.php` and `sign.php` from the site navigation (these are simple PHP pages that can be extended).

Database (optional)
-------------------
This project includes `database_setup.sql` as a starting point if you want to add a MySQL database.

Import the SQL (example using MySQL client):

```bash
mysql -u your_db_user -p your_database_name < database_setup.sql
```

If you enable a DB connection, update the connection file at `sign/db_connect.php` (or your preferred path) with your credentials. The repository currently contains `sign/db_connect.php` for reference.

Project structure (key files)
-----------------------------
- `index.php` — landing / main entry
- `sign.php` — sign-in / sign-up hooks
- `sear.php` — search page
- `card_*.html`, `protofly_user_*.html` — example card and profile templates you can reuse
- `img/` — image assets (replace with your own optimized images)
- `js/` — front-end scripts
- `pro/` — scoped CSS files for pages and components
- `database_setup.sql` — starter SQL if you want to add a DB
- `sign/db_connect.php` — example DB connector location

Customization notes
-------------------
- Replace images in `img/` with optimized images (webp/avif where possible).
- Edit styles in `pro/` to match your colors and typography; the CSS is modular.
- Add interactivity in `js/` or connect templates to a backend API for dynamic content.
- Keep templates `card_*.html` as components — copy and adapt per artist or project.

Deployment
----------
Upload the project to any PHP-capable host (shared hosting, managed PHP host, or a VPS). Ensure:
- `index.php` is reachable at the site root
- File permissions allow the web server to read assets
- If using a database, update credentials and restrict access accordingly

Security & maintenance notes
---------------------------
- Do not commit production credentials. Use environment variables or a config file excluded from version control.
- Sanitize and validate user input if you extend sign/search pages — the included PHP pages are intentionally minimal.
- Optimize large images before publishing to improve page load.

