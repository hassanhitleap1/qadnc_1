<?php

use yii\db\Migration;

/**
 * Class m220313_132245_add_column_association_activities
 */
class m220313_132245_add_column_association_activities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%association_activities}}', 'image', $this->string(500)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220313_132245_add_column_association_activities cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220313_132245_add_column_association_activities cannot be reverted.\n";

        return false;
    }
    */
}
