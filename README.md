### Клонуємо проект

git clone git@github.com:leoxopow/ocean-blog.git

### Переходимо в директорію з проектом

cd ocean-blog

### Копіюємо всі файл середовища

cp .env.example .env

### Щоб встановити необхідні бібліотеки виконуємо команду для докера

```docker run --rm -it \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install```

### Після установки бібліотек можемо запускати сам образ

./vendor/bin/sail up -d

### Виконуємо міграції і сідування для того щоб отримати базу та тестові дані

./vendor/bin/sail artisan migrate:fresh --seed

### Посилання на документацію Swagger
http://localhost/api/documentation

