<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id')->comment('文章表');
            $table->char('title')->default('')->comment('标题');
            $table->char('thumb_img')->default('')->comment('缩略图');
            $table->char('attachment')->default('')->comment('文件');
            $table->char('intro')->default('')->comment('介绍');
            $table->char('keywords')->default('')->comment('关键字-SEO');
            $table->char('description')->default('')->comment('描述-SEO');
            $table->integer('cat_id')->index()->default(0)->comment('分类id');
            $table->integer('hits')->default(0)->comment('点击次');
            $table->integer('sort')->index()->default(0)->comment('排序,越大越靠前');
            $table->integer('admin_id')->default(0)->comment('管理员id');
            $table->char('template', 50)->default('')->comment('content模板');
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
