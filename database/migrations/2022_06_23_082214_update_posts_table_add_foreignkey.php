<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTableAddForeignkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // $table->unsignedBigInteger('category_id');

            // $table->foreign('category_id') // nome campo della FK
                // ->references('id') // qual’è il collegamento con l’altra tabella
                // ->on('categories') // nome dell’altra tabella
                
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string("image")->nullable();
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
            $table->dropForeign(['category_id']);
            $table->dropColumn("category_id");
            $table->dropColumn("image");
        });
    }
}
