Yii 2 Test Application
============================

INSTALLATION
------------

Make a folder and move into it:
`mkdir yii2 && cd $_`

Install from git:
`git clone git@github.com:sedpro/yii2-test-app.git .` 

Install composer:
`curl -sS https://getcomposer.org/installer | php`

Run composer:
`php composer.phar install`

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
