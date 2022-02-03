<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Colonna per FK
            $table->unsignedBigInteger('category_id')->nullable()->after('id'); //La rendiamo nulla (es.uncategorized as Wp e posizionata dopo la colonna id)

            // Definizione per FK constrain
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null'); //Per non lasciare id orfani nel caso la categoria venisse cancellata
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_category_id_foreign'); //Indichiamo tabella posts da cui vogliamo togliere la colonna category_id che è la foreign key
            $table->dropColumn('category_id');
        });
    }
}
