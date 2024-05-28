## Booky.co test assignment

### Описание задания:

Необходимо разработать простой REST API для управления задачами (Task
Management System). Система должна позволять пользователям создавать,
просматривать, редактировать и удалять задачи.

<hr>

### Запуск проекта:

Запуск контейнеров

    docker-compose up -d    

Установка зависимостей

    docker-compose exec app composer install

Генерация ключа приложения

    docker-compose exec app php artisan key:generate

Выполнение миграций
    
    docker-compose exec app php artisan migrate

Запуск Feature тестов

    docker-compose exec app php artisan test --filter Feature


<hr>

### Локальный адрес:

Приложение доступно по адресу: http://localhost:80/api/
