# 🚀 MicrosSecondTask

---

## ⚙️ Установка и запуск

Следуйте инструкциям ниже, чтобы развернуть проект локально:

```bash
# 1️⃣ Клонируем репозиторий
git clone https://github.com/explorer16/MicrosSecondTask.git
```

```bash
# 2️⃣ Переходим в папку проекта
cd MicrosSecondTask
```

```bash
# 3️⃣ Запускаем Docker-контейнеры
docker compose up -d
```
```bash
# 4️⃣ Устанавливаем зависимости Laravel
docker exec second_app composer install
```
```bash
# 5️⃣ Копируем файл окружения
docker exec second_app cp .env.example .env
```
```bash
# 6️⃣ Генерируем ключ приложения
docker exec second_app php artisan key:generate
```
```bash
# 7️⃣ Применяем миграции и заполняем тестовыми данными
docker exec second_app php artisan migrate:fresh --seed
```

<hr>
