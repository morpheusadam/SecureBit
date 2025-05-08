<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->foreignId('role_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('permission_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->timestamp('assigned_at')->useCurrent();
            
            $table->primary(['role_id', 'permission_id']);
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
        Schema::dropIfExists('role_permission');
    }
}
