Yii 2 Test Application
============================

INSTALLATION
------------

```
# Make a folder and move into it:
mkdir yii2 && cd $_

# Install from git:
git clone git@github.com:sedpro/yii2-test-app.git .

# Install composer:
curl -sS https://getcomposer.org/installer | php

# Run composer:
php composer.phar install

# Run built-in web server
php -S 127.0.0.1:8080 -t web/

# Open in browser the page
http://127.0.0.1:8080
```

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

TASK
----

Сделать на Yii2 возможность только зарегистрированным пользователям просматривать, удалять, редактировать записи в таблице "books"
|books|
id,
name,
date_create, / дата создания записи
date_update, / дата обновления записи
preview, / путь к картинке превью книги
date, / дата выхода книги
author_id / ид автора в таблице авторы
 
|authors| редактирование таблицы авторов не нужно, необходимо ее просто заполнить тестовыми данными.
id,
firstname, / имя автора
lastname,  / фамилия автора

в итоге страница управления книгами должна выглядеть так:
https://github.com/sedpro/yii2-test-app/blob/master/task.png
