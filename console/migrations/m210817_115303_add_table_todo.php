<?php
use yii\db\Migration;

/**
 * Class m210817_115303_add_table_todo
 */
class m210817_115303_add_table_todo extends Migration
{

    /**
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%todo}}');
        if (!isset($table)) {
            $this->createTable('todo', [
                'id' => $this->primaryKey(11),
                'name' => $this->string(128)
                    ->notNull(),
                'category_id' => $this->integer(11),
                'timestamp' => $this->date()
            ]);

            $this->createIndex('idx-todo-category_id', 'todo', 'category_id');

            $this->addForeignKey('fk-todo-category_id', 'todo', 'category_id', 'category', 'id', 'CASCADE');
        }
    }

    /**
     *
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%todo}}');
        if (isset($table)) {
            $this->dropForeignKey('fk-todo-category_id', 'todo');
            $this->dropTable('todo');
        }
    }
}
