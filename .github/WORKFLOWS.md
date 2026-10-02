# CI/CD Workflows

The four workflows in `.github/workflows/` call the shared ones in
[palasthotel/github-workflows](https://github.com/palasthotel/github-workflows). How
they work, every input and what to do when a deploy fails is described there, in
[docs/wp-plugin.md](https://github.com/palasthotel/github-workflows/blob/main/docs/wp-plugin.md).

What is specific to this plugin:

| | |
|---|---|
| wordpress.org slug | `disable-attachment-pages` |
| main file | `public/disable-attachment-pages.php` - keep the name, see [CONTRIBUTING.md](../CONTRIBUTING.md) |
| version file | `version.txt` (`release-type: simple`) - keep it, release-please and the scripts read the version there |
| build step | none |
| PHP | `php -l` on 7.4, 8.2, 8.3 and 8.4 (the shared default); the plugin declares `Requires PHP: 7.0` |
