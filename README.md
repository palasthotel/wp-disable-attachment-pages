# Disable Attachment Pages

WordPress attachment pages are a URL for every uploaded file — a thin page that
shows the image on its own and is rarely wanted. This plugin sends visitors of
such a page to the content the file belongs to, and hides the option to link
images to their attachment page in the backend.

- **wordpress.org:** https://wordpress.org/plugins/disable-attachment-pages/
- **User documentation:** [public/readme.txt](public/readme.txt) (the text shown on wordpress.org)
- **Changelog:** [CHANGELOG.md](CHANGELOG.md) — release-please owns that file, do
  not add notes to it by hand. Entries before 1.1.1 are in the `== Changelog ==`
  section of [public/readme.txt](public/readme.txt).

## What it does

| Situation | Result |
|---|---|
| Attachment belongs to a published post or page | `301` redirect to that content |
| Attachment has no parent, or the parent is not published | `302` redirect to the site's home URL |
| Backend, media modal and block editor | the "Attachment Page" link option is hidden via CSS |

The redirect runs on `template_redirect` at priority 1, so it happens before a
theme renders anything. Both redirects use `wp_safe_redirect()`, so a filtered
permalink cannot send visitors off-site.

## Repository layout

| Path | Description |
|---|---|
| `public/` | the plugin as it is shipped to wordpress.org |
| `bin/` | release helper scripts |
| `.github/workflows/` | CI/CD — see [.github/WORKFLOWS.md](.github/WORKFLOWS.md) |

Only `public/` is shipped. Everything outside it stays repository-only.

## Development

The plugin is a single PHP file with no build step. Point a local WordPress at
`public/` — for example by symlinking it into `wp-content/plugins/` — or install
the packed zip:

```sh
bash bin/pack.sh   # → disable-attachment-pages.zip
```

## Releasing

Releases are automated with [release-please](https://github.com/googleapis/release-please)
and deployed to the wordpress.org SVN repository. Nothing is bumped by hand —
commit with [conventional commits](https://www.conventionalcommits.org/) and
merge the release PR. See [CONTRIBUTING.md](CONTRIBUTING.md) and
[.github/WORKFLOWS.md](.github/WORKFLOWS.md).

## License

GNU General Public License v3.0 or later — see [LICENSE](LICENSE).
