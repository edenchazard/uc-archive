# UC Archive

This project is an archive of content from the former adoptables site, Unicreatures, which ran from 2009 to 2016.

Much of the content is lost or incomplete, so this is only a partial archive. People are encouraged to submit missing content or corrections via the Issues tab on Github.

## Development

The project is built with:

- [Laravel](https://laravel.com)
- [Tailwind](https://tailwindcss.com/)
- [Docker](https://www.docker.com/)

To run:

1. `docker compose up -d`
2. `docker compose exec app sh -c "php artisan migrate --seed"`
3. `docker compose exec app sh -c "npm run dev"`
4. It should now be visible on `localhost`.

## Production

With every new tag, a new container image is published. Please see the [latest package release for the image](https://github.com/edenchazard/uc-archive/pkgs/container/uc-archive). The latest image will always be tagged with `latest`. For example, the latest image will be available at `ghcr.io/edenchazard/uc-archive:2.1.1`.

## Disclaimer

All content and art is owned by their original creators. This archive makes no claim of the content it contains and is provided for educational and historical purposes only.
