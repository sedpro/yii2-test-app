<?php

use yii\db\Migration;

class m151115_185658_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date_create' => $this->timestamp()->notNull(),
            'date_update' => $this->timestamp()->notNull(),
            'preview' => $this->string()->notNull(),
            'date' => $this->date()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%authors}}', ["id" => "1", "firstname" => "Dan", "lastname" => "Simmons",]);
        $this->insert('{{%authors}}', ["id" => "2", "firstname" => "Iain", "lastname" => "Banks",]);
        $this->insert('{{%authors}}', ["id" => "3", "firstname" => "Karl", "lastname" => "Rodeiguez",]);
        $this->insert('{{%authors}}', ["id" => "4", "firstname" => "Donny", "lastname" => "Yerly",]);
        $this->insert('{{%authors}}', ["id" => "5", "firstname" => "Faviola", "lastname" => "Howzell",]);
        $this->insert('{{%authors}}', ["id" => "6", "firstname" => "Odis", "lastname" => "Bollie",]);
        $this->insert('{{%authors}}', ["id" => "7", "firstname" => "Pierre", "lastname" => "Karpinen",]);
        $this->insert('{{%authors}}', ["id" => "8", "firstname" => "Lyman", "lastname" => "Hermenegildo",]);
        $this->insert('{{%authors}}', ["id" => "9", "firstname" => "Hanna", "lastname" => "Hao",]);
        $this->insert('{{%authors}}', ["id" => "10", "firstname" => "Christiana", "lastname" => "Pulaski",]);

        $this->insert('{{%books}}', [
            "id" => "1",
            "name" => "Flashback",
            "preview" => "QL7X2eo-lXMZV7yvVLXlG57Nj3wUmFdx.jpg",
            "date" => "2011-00-00",
            "author_id" => "1"
        ]);
        $this->insert('{{%books}}', [
            "id" => "2",
            "name" => "Complicity",
            "preview" => "o6ix91apxDeO8PvqKkJXiR1pMMpNVeJC.jpg",
            "date" => "1993-04-01",
            "author_id" => "2"
        ]);
        $this->insert('{{%books}}', [
            "id" => "3",
            "name" => "Other book",
            "preview" => "",
            "date" => "1995-07-05",
            "author_id" => "3"
        ]);
        $this->insert('{{%books}}', [
            "id" => "4",
            "name" => "One more book",
            "preview" => "",
            "date" => "1997-07-05",
            "author_id" => "4"
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%authors}}');
        $this->dropTable('{{%books}}');
    }
}
