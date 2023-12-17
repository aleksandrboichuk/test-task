# Тестове завдання

### Завдання
-  Зробити CRUD на Laravel зі збереженням даних у БД MySQL функції програми:
- реєстрація\авторизація
- додавання нових записів
- перегляд і редагування наявних записів
- видалення записів
- Для фронту можна використовувати bootstrap;
- Створення таблиць реалізувати через міграції;

### Виконано:
- Реалізовано реєстарцію та авторизацію
- Реалізовано сторінки: перегляду усіх записів, одного запису, редагування, створення
- Реалізовано CRUD сутностей User та Post зі збереженням у БД
- Покрито PHPUnit тестами усі CRUD операції, сторінки, реєстрацію, авторизацію.

### Розгортання проєкту:
- Перейти у робочу директорію та виконати наступні команди в консолі:
    + `git clone https://github.com/aleksandrboichuk/test-task.git` - клонування проєкту у робочу директорію
    + `cd test-task`
    + `cp .env.example .env && cd docker && cp docker-compose.example.yml docker-compose.yml` - копіювання конфігураційних файлів для docker-compose та laravel
    + `chmod -R 777 data && chmod -R 777 logs` - встановлення прав на директорії логів та даних
    + `docker-compose build && docker-compose up -d` - білд та підняття контейнерів
    + `docker-compose exec php-fpm bash` - перехід у php-fpm контейнер для встановлення композеру (та виконання в майбутньому artisan команд)
    + `composer install` - встановлення composer
    + `php artisan migrate --seed` - виконання міграцій та заповнення тестовими данними БД
    + `php artisan test` - виконання PHPUnit тестів

Проєкт має бути доступним за посиланням http://localhost

### Додаткова інформація про реалізацію:
1. Шаблон проєктування

    Проєкт виконаний із застосуванням шаблону проєктування Сервісний шар (Service layer). 
    
    Сервіси з бізнес-логікою знаходяться у директорії [Services](app/Services). 

    За кожним сервісом закріплений окремий інтерфейс ([Interfaces](app/Interfaces)) в [AppServiceProvider](app/Providers/AppServiceProvider.php).
    
    Для сервісів, які відповідають за бізнес-логіку, яка стосується моделей реалізовано абстрактний клас, який вони наслідують -
[ModelService](app/Services/ModelService.php), в ньому знаходяться загальні методи, які можуть бути застосовані для будь-яких
моделей.

    Сервіси використовуться у [контролерах](app/Http/Controllers), [Request-ах](app/Http/Requests) 
та [PHPUnit тестах](tests/Feature). При потребі використання сервісу - використовується саме його інтерфейс, за яким він закріплений.
2. Resources

    CRUD-операції реалізовані з використанням [resource-маршрутизації](routes/web.php) та 
[resource контролерів](app/Http/Controllers/Resource). Для прдібних контролерів був реалізований абстрактиний resource-контролер
([ResourceController](app/Http/Controllers/Resource/ResourceController.php)). У ньому знаходяться загальні resource-методи, 
які є подібними у кожному resource-контролері: повернення view для сторінки редагування, перегляду запису сутності,
або виведення таблиці с усіма записами сутності. Окремим випадком є методи store та update сутності. вони реалізовані окремо у контролері кожної сутності,
оскільки вони приймають різни Request-и, а точніше іх класи.
   
3. PHPUnit
    CRUD-операції, авторизацію, реєстрацію та сторінки проєкту покрито [PHPUnit тестами](tests/Feature). 
Виконується перевірка усіх кейсів, як успішних так і неуспішних, перевірка коректності роботи валідаціїта.
