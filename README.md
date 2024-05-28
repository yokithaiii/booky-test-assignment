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

Выполнение миграций
    
    docker-compose exec app php artisan migrate

Запуск локального веб-сервера

    docker-compose exec app php artisan serve

Запуск Feature тестов

    docker-compose exec app php artisan test --filter Feature



