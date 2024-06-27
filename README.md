# Orchid Platform

Данный репозиторий предназначен для инициализации пустого проекта, который содержит в себе:
 - [Laravel 11.9](https://github.com/laravel/framework/releases/tag/v11.9.1)
 - [Orchid Platform 14.24](https://github.com/orchidsoftware/platform/releases/tag/14.24.0)

Для инициализации проекта, необходимо произвести установку зависимостей через Composer, создать `.env` файл, а также инициализацию ключа приложения:

```bash
$ composer require --dev
Search for a package: [НАЖМИТЕ ENTER]
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate
```

Проект готов для дальнейшей настройки...
# exam
