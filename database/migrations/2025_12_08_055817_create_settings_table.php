<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('favicon');
            $table->string('site_title');
            $table->text('desc')->nullable();
            $table->string('hotline')->nullable();
            $table->string('time')->nullable();
            $table->string('mail')->nullable();
            $table->string('copyright')->nullable();


            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Pixel Analytics
            $table->text('facebook_pixel')->nullable();
            $table->text('google_analytics')->nullable();

            // Indexing Control
            $table->boolean('allow_indexing')->default(true);
            $table->text('custom_header_scripts')->nullable();
            $table->text('custom_footer_scripts')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
