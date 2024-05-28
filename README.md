## Booky.co test assignment

### Описание задания:

Необходимо разработать простой REST API для управления задачами (Task
Management System). Система должна позволять пользователям создавать,
просматривать, редактировать и удалять задачи. 

**Все поставленные задачи, в том числе дополнительные, выполнены.**

<hr>

### Запуск проекта:

Запуск контейнеров

    docker-compose up -d    


Установка зависимостей

    docker-compose exec app composer install

Генерация ключа приложения (.env вывел с .gitignore)

    docker-compose exec app php artisan key:generate

Выполнение миграций
    
    docker-compose exec app php artisan migrate

Запуск Feature тестов

    docker-compose exec app php artisan test --filter Feature


<hr>

### Локальный адрес:

Приложение доступно по адресу: http://localhost:80

Роуты для проверки через Postman:
 - `POST /api/register` - Регистрация
 - `POST /api/login` - Логин
 - `POST /api/logout` - Выход
 - `GET /api/tasks` - Просмотр всех задач
 - `POST /api/tasks` - Создание задачи
 - `GET /api/tasks/{id}` - Просмотр задачи юзера
 - `PUT /api/tasks/{id}` - Обновление задачи
 - `DELETE /api/tasks/{id}` - Удаление задачи
