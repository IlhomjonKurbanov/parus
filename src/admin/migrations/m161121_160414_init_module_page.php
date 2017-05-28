<?php

use rokorolov\parus\page\models;
use rokorolov\parus\user\models\User;
use rokorolov\parus\language\models\Language;

class m161121_160414_init_module_page extends \rokorolov\parus\admin\base\BaseMigration
{
    public function up()
    {
        $tableOptions = $this->tableOptions;

        $this->createTable(models\Page::tableName(), [
            'id' => $this->primaryKey(10)->unsigned(),
            'status' => $this->smallInteger(2)->notNull(),
            'language' => $this->integer(10)->notNull()->unsigned(),
            'title' => $this->string(512)->notNull(),
            'slug' => $this->string(512)->notNull(),
            'content' => $this->text()->notNull(),
            'hits' => $this->integer(10)->unsigned()->notNull()->defaultValue('0'),
            'home' => $this->integer(3)->unsigned()->defaultValue('0'),
            'view' => $this->string(128),
            'version' => $this->integer(10)->unsigned()->defaultValue('1'),
            'reference' => $this->string(),
            'updated_by' => $this->integer(10)->notNull()->unsigned(),
            'created_by' => $this->integer(10)->notNull()->unsigned(),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'meta_title' => $this->string(128)->defaultValue(null),
            'meta_keywords' => $this->string(255)->defaultValue(null),
            'meta_description' => $this->string(255)->defaultValue(null),
            'deleted_at' => $this->timestamp()->null()->defaultValue(null)
        ], $tableOptions);

        $this->createIndex('slug_idx', models\Page::tableName(), 'slug');
        $this->addForeignKey('fk__page_created_by__user_id', models\Page::tableName(), 'created_by', User::tableName(), 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk__page_updated_by__user_id', models\Page::tableName(), 'updated_by', User::tableName(), 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk__page_language__language_id', models\Page::tableName(), 'language', Language::tableName(), 'id', 'CASCADE', 'CASCADE');
    }
    
    public function down()
    {
        $this->dropIndex('slug_idx', models\Page::tableName());
        
        $this->dropForeignKey('fk__page_created_by__user_id', models\Page::tableName());
        $this->dropForeignKey('fk__page_updated_by__user_id', models\Page::tableName());
        $this->dropForeignKey('fk__page_language__language_id', models\Page::tableName());
        
        $this->dropTable(models\Page::tableName());
    }
}

