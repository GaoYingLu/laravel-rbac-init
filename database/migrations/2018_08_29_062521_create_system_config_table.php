<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('system_config', function (Blueprint $table) {
            $table->increments('id')->comment('系统配置表');
            $table->char('config_key', 50)->default('')->comment('配置 key');
            $table->char('config_key_md5', 32)->default('')->comment('配置 key')->unique();
            $table->text('config_value')->comment('内容信息，存储 json 格式数据');
            $table->tinyInteger('status')->default('1')->comment('0:下线；1：正常');
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
