
# aheadz

Тестовое задание в компанию Ahead
Описание: Веб приложение для управления своим зоопарком






## Установка

Клонируйте репозиторий

```bash
  git clone https://github.com/kindanick/aheadz.git
  cd aheadz
```

Запустите Docker контейнеры

```bash
    docker compose up -d --build
```

Установите зависимости и выполните миграции

```bash
    docker compose exec app composer install
    docker compose exec app php artisan key:generate
    docker compose exec app php artisan migrate
```

Приложение доступно по адресу

```
  localhost:8000
```
    
## Переменные окружения

Креды базы данных в .env файле

`DB_CONNECTION=mysql`

`DB_HOST=db`

`DB_PORT=3306`

`DB_DATABASE=aheadz_db`

`DB_USERNAME=root`

`DB_PASSWORD=secret`

## Схема БД

Схема БД описана с помощью [dbdiagram.io](https://dbdiagram.io/home)

[dbdiagram](https://dbdiagram.io/d/aheadz-6638f6059e85a46d551e17d5)

[dbdocs](https://dbdocs.io/kalinovne.io/aheadz)

