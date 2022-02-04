<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();

            // Foreign Key per post
            $table->unsignedBigInteger('post_id');

            $table->foreign('post_id') //colonna che voglio usare
                ->references('id') //mi relaziono con l'id
                ->on('posts') //tabella a cui voglio puntare
                ->onDelete('cascade'); //Se cancello un post mi cancella anche le relazioni cnella tabella pivot


            // Foreign Key per tag
            $table->unsignedBigInteger('tag_id');
            
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
        
    }
}