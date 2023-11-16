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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_task_id')->nullable()->after('id');
            $table->index('parent_task_id', 'task_parent_task_id_idx');
            $table->foreign('parent_task_id', 'task_parent_task_id_fk')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('task_parent_task_id_fk');
            $table->dropIndex('task_parent_task_id_idx');
            $table->dropColumn('parent_task_id');
        });
    }
};
