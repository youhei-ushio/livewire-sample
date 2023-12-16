# install

## composer install
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

## sail
```
sail up -d
```

## setup
```
cp -p .env.example .env
sail artisan key:generate
sail artisan migrate
sail artisan db:seed class=MasterProductSeeder
```

## vite
```
sail npm install
sail npm run dev
```
