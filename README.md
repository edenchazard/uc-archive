# UC Archive

This project is an archive of content from the former adoptables site, Unicreatures, which ran from 2009 to 2016.

Much of the content is lost or incomplete, so this is only a partial archive. People are encouraged to submit missing content or corrections via the Issues tab on Github.

## Development

The project is built with:

- [Laravel](https://laravel.com)
- [Tailwind](https://tailwindcss.com/)
- [Docker](https://www.docker.com/)

SQLite is used for simplicity and portability.

To run:

1. `docker compose up -d`
2. `docker compose exec php sh -c "npm run dev"`
3. It should now be visible at [localhost](http://localhost/).

## Production

With every new tag, a new container image is published. Please see the [latest images](https://github.com/edenchazard/uc-archive/pkgs/container/uc-archive). Every release follows typical semantic versioning.

The newest image will always be tagged with `latest`.

The image contains the database file with the migrations already applied, ready to be used immediately.

## Disclaimer

All content and art is owned by their original creators. This archive makes no claim of the content it contains and is provided for educational and historical purposes only.
