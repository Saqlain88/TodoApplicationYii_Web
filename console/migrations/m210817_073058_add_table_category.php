<?php
use yii\db\Migration;

/**
 * Class m210817_073058_add_table_category
 */
class m210817_073058_add_table_category extends Migration
{

    /**
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(128)->notNull()
        ]);
    }

    /**
     *
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%category}}');
        if (isset($table)) {
            $this->execute("DROP TABLE `category`");
        }
    }
}
