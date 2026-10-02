# Contributing

## Code of Conduct

The project has a [Code of Conduct](./CODE_OF_CONDUCT.md) to which all contributors must adhere.

## Branching

`main` is the default branch and always reflects what is released, or about to
be. Work on a feature branch and open a pull request against `main`.

## Commit messages

Releases and the changelog are generated from the commit history by
[release-please](https://github.com/googleapis/release-please), so commit
messages follow [Conventional Commits](https://www.conventionalcommits.org/):

```
<type>[optional scope][!]: <description>
```

| Type | Effect on the version | Appears in changelog |
|---|---|---|
| `fix:` | patch (1.1 → 1.1.1) | yes, "Bug Fixes" |
| `feat:` | minor (1.1 → 1.2.0) | yes, "Features" |
| `feat!:` or a `BREAKING CHANGE:` footer | major (1.1 → 2.0.0) | yes, highlighted |
| `docs:`, `refactor:`, `chore:`, `deps:`, `ci:`, `style:`, `test:` | none | no |

A pull request that should trigger a release needs at least one `fix:` or
`feat:` commit. When squash-merging, the squash commit message itself has to be
a conventional commit — that is the message release-please reads.

To force a specific version regardless of commit types, add a `Release-As: x.y.z`
footer to a commit.

### Which changes get `fix:` or `feat:`

Only changes that matter to someone using the plugin. `fix:` and `feat:` decide
the version *and* write the line that ends up in the changelog on the
wordpress.org plugin page, so the question to ask before committing is whether a
user of the plugin would care about that line.

Everything else takes a type that releases nothing — workflows and CI, release
tooling, repository documentation, internal refactoring, and anything touching
files that are not shipped. As a rule of thumb, a change confined to files
outside `public/` is almost never a `fix:`.

That includes hardening. Blocking direct access to a file that is not part of the
download is `chore:`, not `fix:` — nothing changes for anyone who installed the
plugin.

## Versions

Never edit version numbers by hand. `version.txt`, `CHANGELOG.md`,
`public/disable-attachment-pages.php` and the `Stable tag:` in `public/readme.txt` are maintained
by the release pipeline, which is documented in
[.github/WORKFLOWS.md](./.github/WORKFLOWS.md).

Content changes to `public/readme.txt` — description, FAQ, tested-up-to — are of
course made by hand; just leave `Stable tag:` and the `== Changelog ==` entries
alone.

## Repository layout

| Path | Description |
|---|---|
| `public/` | the plugin as it is shipped to wordpress.org |
| `public/disable-attachment-pages.php` | main file: the redirect and the admin CSS |
| `public/readme.txt` | the wordpress.org listing |
| `plugin.php` | development wrapper loading `public/`, for local testing only; never deployed |
| `version.txt` | the version release-please maintains |
| `.github/workflows/` | CI/CD |

Only `public/` is shipped. Everything outside it stays repository-only.

The main file `public/disable-attachment-pages.php` must keep its name. WordPress
identifies an installed plugin by `<directory>/<main file>` and stores that pair in
`active_plugins`; renaming it deactivates the plugin on every site at the next update.

## Local environment

There is nothing to build or install. wp-env runs without a configuration file and
mounts the repository as the plugin through the development wrapper:

```sh
npx @wordpress/env start      # http://localhost:8888, admin / password
```

To produce the distributable zip, with
[palasthotel/github-workflows](https://github.com/palasthotel/github-workflows) checked
out next to this repository:

```sh
SLUG=disable-attachment-pages bash ../github-workflows/wp-plugin/bin/pack.sh
# → build/disable-attachment-pages/ and disable-attachment-pages.zip
```

## Checks

Every PR runs `php -l` against PHP 7.4, 8.2, 8.3 and 8.4, packs the plugin and checks
the payload, and checks the version carriers agree. The plugin declares `Requires PHP: 7.0`, so avoid syntax newer than that
unless you raise the requirement in the plugin header and `public/readme.txt` in
the same PR.
