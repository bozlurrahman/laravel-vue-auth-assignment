
# Laravel + vue with simple authentication

## Vue Project setup
configure .env file
```bash
cp .env.example .env
composer install
php artisan migrate:fresh --seed
php artisan jwt:secret
php artisan storage:link
php artisan serve
```
## Vue Project setup
```
cd vue
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```