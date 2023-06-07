<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoCommunitys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_communitys', function (Blueprint $table) {
            $table->bigIncrements('id');
            //Community info
            $table->string('title', 255)->nullable();
            $table->string('slug',255)->charset('utf8')->index();
            $table->text('content')->nullable();
            $table->integer('image_id')->nullable();
            $table->integer('banner_image_id')->nullable();
            $table->text('short_desc')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('map_lat',20)->nullable();
            $table->string('map_lng',20)->nullable();
            $table->integer('map_zoom')->nullable();
            $table->tinyInteger('is_featured')->nullable();
            $table->string('gallery', 255)->nullable();
            $table->string('video', 255)->nullable();
            //Price
            $table->decimal('price', 12,2)->nullable();
            $table->decimal('sale_price', 12,2)->nullable();

            //Community type
            $table->integer('duration')->nullable();
            $table->integer('min_people')->nullable();
            $table->integer('max_people')->nullable();

            //Extra Info
            $table->text('faqs')->nullable();
            $table->string('status',50)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->softDeletes();

            //Languages
            $table->bigInteger('origin_id')->nullable();
            $table->string('lang',10)->nullable();
            $table->timestamps();
        });

        Schema::create('bravo_community_term', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('term_id')->nullable();
            $table->integer('community_id')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('bravo_community_translations', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            //Tour info
            $table->string('title', 255)->nullable();
            $table->string('slug',255)->charset('utf8')->index();
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();
            $table->string('address', 255)->nullable();
            $table->text('faqs')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->unique(['origin_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bravo_communitys');
        Schema::dropIfExists('bravo_community_term');
        Schema::dropIfExists('bravo_community_translations');
    }
}
