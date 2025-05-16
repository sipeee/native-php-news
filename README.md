# Native PHP News

## Setup developer environment

The project was developed under Docker. So you have to own one on your opsystem under.

The easiest way to create and start runtime of developer environment is to run the following command:

> docker compose up -d

Such way your demo site will be available on following URL:

- http://127.0.0.1:8014/

To migrate database you have to log in to docker container and have to run migration command:

> docker exec -ti blog-web bash
>
> phpmig migrate

You can use following user credentials after migration:
- sipiszoty@gmail.com/password1
- tesztelek@hammeragency.eu/password2
- nagyistvan@hammeragency.eu/password3


