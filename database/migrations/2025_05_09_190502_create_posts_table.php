<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('excerpt')->nullable();
    $table->text('content');
    $table->string('featured_image')->nullable();
    $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
    $table->enum('status', ['published', 'draft', 'archived', 'pending'])->default('draft');
    $table->timestamp('published_at')->nullable();
    $table->boolean('is_featured')->default(false);
    $table->integer('view_count')->default(0);
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->json('meta_keywords')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
