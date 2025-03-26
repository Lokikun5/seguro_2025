<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name');
            $table->enum('type', ['photo', 'video']);
            $table->text('legende')->nullable();
            $table->boolean('gallery_page')->default(false);
            $table->unsignedBigInteger('event_page_id')->nullable();
            $table->unsignedBigInteger('page_id')->nullable();
            $table->unsignedBigInteger('resident_page_id')->nullable();
            $table->timestamps();

            $table->foreign('event_page_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('resident_page_id')->references('id')->on('residents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
