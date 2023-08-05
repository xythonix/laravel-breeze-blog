<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('post_img')->nullable();
            $table->text('description');
            
            // FOREIGN KEY OF CATEGORY TABLE
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')
                    ->references('id')
                    ->on('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            // FOREIGN KEY OF AUTHOR TABLE
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                    ->references('id')
                    ->on('authors')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
