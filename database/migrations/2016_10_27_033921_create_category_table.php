<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id')->comment('文章分类表');
            $table->integer('pid')->default(0)->comment('上级分类id');
            $table->char('name')->default('')->comment('名称');
            $table->char('alias')->default('')->comment('别名');
            $table->integer('sort')->default(0)->comment('排序,越大越靠前');
            $table->integer('admin_id')->default(0)->comment('管理员id');
            $table->char('intro')->default('')->comment('介绍');
            $table->char('template')->default('')->comment('列表模板');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
