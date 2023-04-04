## Run Laravel project

-   Clone the project

*   Go to the folder application using cd command on your cmd or terminal

-   Run -> composer install

-   Run -> cp .env.example .env

-   Run -> php artisan key:generate

-   Run -> php artisan jwt:secret

-   Run -> php artisan migrate

-   Run -> php artisan serve

*   Go to the .env and set
    - MAIL_MAILER=smtp
    - MAIL_HOST=mailpit
    - MAIL_PORT=1025
    - MAIL_USERNAME=null
    - MAIL_PASSWORD=null
    - MAIL_ENCRYPTION=null
    - MAIL_FROM_ADDRESS="hello@example.com"
    - MAIL_FROM_NAME="${APP_NAME}"
