<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hook', function (Blueprint $table)
        {
            $table->string('name', 30)->default('')->comment(trans('hook::public.name'));
            $table->string('module', 30)->default('manage')->comment(trans('hook::public.module'));
            $table->text('description', 255)->comment(trans('hook::public.description'));
            $table->tinyInteger('issystem', false)->default(0)->comment(trans('hook::public.issystem'));
            $table->integer('times')->nullable()->comment(trans('hstcms::manage.times'));
            $table->text('document', 255)->comment(trans('hook::public.document'));
            $table->primary('name');
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
        Schema::drop('hook');
    }
}
