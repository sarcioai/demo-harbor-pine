# demo-harbor-pine

**Harbor & Pine Landscaping** is a fictional landscaping company in Tacoma,
Washington, whose WordPress site brings in its work through a "Get a free
quote" form. Two things on it are broken, the way things break on real sites
after an update, and [Sarcio](https://www.sarcio.io) fixes both live: one in
the browser, one on the server.

|           |                                                                    |
| --------- | ------------------------------------------------------------------ |
| Live demo | [demos.sarcio.io/harbor-pine](https://demos.sarcio.io/harbor-pine) |
| Shows     | a front-end fix and a server-side fix through the Sarcio WordPress plugin and the Sarcio sidecar |
| Fix PR    | opens on this repository (GitHub)                                  |

WordPress core and the official **SQLite drop-in** (no database server) come
from wordpress.org, and the Sarcio plugin is an ordinary Composer dependency,
exactly as a customer installs it. Server-side fixes arrive through the Sarcio
sidecar running beside WordPress, the fast path for a host that can run a
service.

## What's broken

1. **"The quote button shows quote_form.submit_button."** Since 1.4 the quote
   plugin (`wp-content/mu-plugins/harbor-quote-requests.php`) looks for its
   translation file in a folder a must-use plugin doesn't have, so the form's
   button prints its string key instead of "Request my free quote". A fix
   approved in Sarcio puts the label back for every visitor; the pull request
   with the permanent fix edits the plugin.
2. **"The quote form says my phone number is invalid."** Since 1.4 the quote
   plugin (`wp-content/mu-plugins/harbor-quote-requests.php`) accepts only ten
   bare digits, so `(253) 555-0142` is refused and the lead is lost. The form
   posts to `admin-ajax.php`. A fix approved in Sarcio lets those requests
   through while the permanent fix is reviewed. If Sarcio is unavailable the
   site behaves exactly as it did before.

## Run it

```bash
docker build --secret id=composer_auth,src=auth.json -t demo-harbor-pine .
docker run -p 4014:4014 -e SARCIO_BASE_PATH=/harbor-pine demo-harbor-pine
# http://localhost:4014/harbor-pine
```

Environment: `PORT`, `SARCIO_BASE_PATH`, `SARCIO_SITE_KEY`, `SARCIO_API_URL`,
`SARCIO_WIDGET_SRC`, `SARCIO_SIDECAR_DSN` + `SARCIO_SHIM_TOKEN` (the sidecar
socket this demo talks to), and `HARBOR_ADMIN_PASSWORD` for wp-admin. Behind a
proxy, send `X-Forwarded-Proto` so WordPress emits URLs in the visitor's
scheme.
The site key, the secret key and the admin password are applied each time the
container starts (`connect.php`), so Settings → Sarcio shows the keys the way a
site owner would have pasted them in.

The site is written at build time (`setup.php`, then `provision.php`) and the
database is baked into the image, so recreating the container resets it to its
broken state. Quote requests land under **Quote requests** in wp-admin.

Photos are from Unsplash, used under the Unsplash License (see
[`assets/CREDITS.md`](assets/CREDITS.md)).
