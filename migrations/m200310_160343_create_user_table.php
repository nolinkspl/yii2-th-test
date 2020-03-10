<?php

use yii\db\Migration;

/**
 * Class m200310_160343_init
 */
class m200310_160343_create_user_table extends Migration
{
    private $userTable = 'user';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->getTableSchema($this->userTable, true) === null) {
            $sql = "CREATE TABLE {$this->userTable} (
                      id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                      username varchar(255) NOT NULL UNIQUE,
                      balance float(8,2) NOT NULL DEFAULT 0,
                      PRIMARY KEY (id)
                    )
                    ENGINE = INNODB,
                    CHARACTER SET utf8,
                    COLLATE utf8_general_ci;
            ";

            $this->db->createCommand($sql)->execute();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->userTable);
    }
}
