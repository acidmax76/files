<?php

use yii\db\Migration;

/**
 * Class m190722_171820_add_table_dir
 */
class m190722_171820_add_table_dir extends Migration
{
    private $table;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->table = 'dir';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "files from root directory"';
        };

        $this->createTable($this->table, [
            'name' => $this->string()->comment('Название папки или файла'),
            'size' => $this->string()->comment('Размер'),
            'extension' => $this->string()->comment('Расширение файла'),
            'date' => $this->integer()->comment('Дата последней модификации'),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable($this->table);

    }


}
