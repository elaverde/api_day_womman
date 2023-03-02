<?php

use \Migrations\Migration;

class CreateTableTracing extends Migration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $this->schema->create('tracing', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->increments('id');
            $table->string('sender_full_name',150);
            $table->string('recipient_full_name',150);
            $table->string('recipient_email',150);
            $table->integer('mail_status');
            $table->text('mail_content');
            $table->text('mail_log');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
        });
        
       
    }
    public function down()
    {
        $this->schema->drop('users');
    }
}
