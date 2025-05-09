<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->text('content');
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
    $table->enum('status', ['approved', 'pending', 'spam', 'trash'])->default('pending');
    $table->string('author_name')->nullable();
    $table->string('author_email')->nullable();
    $table->string('author_ip')->nullable();
    $table->string('author_user_agent')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
