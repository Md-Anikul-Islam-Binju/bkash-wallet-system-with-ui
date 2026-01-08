# Project Setup
composer update
# Project Setup .env
cp .env.example .env
# Project Setup Key
php artisan key:generate
# Project Setup migrate
php artisan migrate


# .env file some setup
APP_NAME=BkashWallet
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bkash_wallet
DB_USERNAME=root
DB_PASSWORD=
CACHE_DRIVER=redis
SESSION_DRIVER=database
#SESSION_DRIVER=database