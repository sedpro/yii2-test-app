<?php

namespace app\actions;

use yii\base\Action;
use Yii;

class PrepareAction extends Action
{
    public function run()
    {
        $sql = "
            DROP TABLE IF EXISTS `authors`;
            CREATE TABLE `authors` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `firstname` varchar(255) NOT NULL,
              `lastname` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES
            (1, 'Dan', 'Simmons'),
            (2, 'Iain', 'Banks'),
            (3, 'Karl', 'Rodeiguez'),
            (4, 'Donny', 'Yerly'),
            (5, 'Faviola', 'Howzell'),
            (6, 'Odis', 'Bollie'),
            (7, 'Pierre', 'Karpinen'),
            (8, 'Lyman', 'Hermenegildo'),
            (9, 'Hanna', 'Hao'),
            (10, 'Christiana', 'Pulaski');

            DROP TABLE IF EXISTS `books`;
            CREATE TABLE `books` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `preview` varchar(255) NOT NULL,
              `date` date NOT NULL,
              `author_id` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `author_id` (`author_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `books` (`id`, `name`, `date_create`, `date_update`, `preview`, `date`, `author_id`) VALUES
            (1,	'Flashback',	'2015-11-12 12:36:31',	'2015-11-12 12:36:31',	'QL7X2eo-lXMZV7yvVLXlG57Nj3wUmFdx.jpg',	'2011-00-00',	1),
            (2,	'Complicity',	'2015-11-12 12:38:42',	'2015-11-12 12:38:42',	'o6ix91apxDeO8PvqKkJXiR1pMMpNVeJC.jpg',	'1993-04-01',	2),
            (3,	'Other book',	'2015-11-12 12:40:00',	'2015-11-12 12:40:00',	'',	'1995-07-05',	3),
            (4,	'One more book','2015-11-12 12:50:00',	'2015-11-12 12:50:00',	'',	'1997-07-05',	4);
        ";

        Yii::$app->db->createCommand($sql)->query();

        Yii::$app->getSession()->setFlash('success', 'Таблицы успешно созданы!');

        return $this->controller->redirect('/book/index');
    }
}