<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170608_095851_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('名称'),
            'intro'=>$this->text()->comment('简介'),
             'sort'=>$this->integer(11)->comment('排序'),
            'status'=>$this->integer(2)->comment('状态'),
            'is_help'=>$this->integer(1)->comment('类型'),
        ]);
//        CONSTRAINT `teacher_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE cascade)
//        $this->addForeignKey('article','article','id',);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
