# 🚀 MicrosSecondTask

---

## ⚙️ Установка и запуск

Следуйте инструкциям ниже, чтобы развернуть проект локально:

Клонируем репозиторий
```bash

git clone https://github.com/explorer16/MicrosSecondTask.git
```
Переходим в папку проекта
```bash

cd MicrosSecondTask
```
Запускаем Docker-контейнеры
```bash
docker compose up -d
```
Устанавливаем зависимости Laravel
```bash 
docker exec second_app composer install
```
Копируем файл окружения
```bash
docker exec second_app cp .env.example .env
```
Генерируем ключ приложения
```bash

docker exec second_app php artisan key:generate
```
Применяем миграции и заполняем тестовыми данными
```bash

docker exec second_app php artisan migrate:fresh --seed
```
Создаём клиента
```bash

docker exec second_app php artisan passport:client --personal
```
Создаём ключи
```bash

docker exec second_app php artisan passport:keys
```
Ставим правильные привилегии файлам
```bash
docker exec second_app chmod -R 775 storage
docker exec second_app chown -R www-data:www-data /var/www/storage
docker exec second_app chmod 600 storage/oauth-private.key
docker exec second_app chmod 660 storage/oauth-public.key
```

Далее следует создать пользователя, после его создания будет выдан токен
http://localhost:8080/register

Переходим в хранилище minio localhost:9001 и создаём bucket [second]

Далее переходим RabbitMQ dashboard http://localhost:15672/ и создаём очередь [products_import_queue]

Запускаем воркер
```bash

docker exec second_app php artisan queue:work
```

Приложение готово к работе
