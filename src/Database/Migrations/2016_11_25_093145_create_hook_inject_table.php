<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHookInjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hook_inject', function (Blueprint $table)
        {
            $table->increments('id')->comment('ID');
            $table->string('hook_name', 50)->default('')->comment(trans('hook::public.hook.name'));
            $table->string('alias', 100)->default('')->comment(trans('hook::public.alias'));
            $table->string('files', 150)->default('')->comment(trans('hook::public.files'));
            $table->string('class', 50)->default('root')->comment(trans('hook::public.class'));
            $table->string('fun', 50)->default('root')->comment(trans('hook::public.fun'));
            $table->text('description', 255)->comment(trans('hook::public.description'));
            $table->tinyInteger('issystem', false)->default(0)->comment(trans('hook::public.issystem'));
            $table->integer('times')->nullable()->comment(trans('hstcms::manage.times'));
            $table->unique(['hook_name', 'alias']);
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
        Schema::drop('hook_inject');
    }
}
