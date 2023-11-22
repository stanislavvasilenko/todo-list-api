<?php

use App\Models\Enums\TaskStatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('status_id');
            $table->unsignedBigInteger('priority_id')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->index('user_id', 'task_user_idx');
            $table->foreign('user_id', 'task_user_fk')->references('id')->on('users');

            // $table->index('status_id', 'task_status_idx');
            // $table->foreign('status_id', 'task_status_fk')->references('id')->on('statuses');

            $table->index('priority_id', 'task_priority_idx');
            $table->foreign('priority_id', 'task_priority_fk')->references('id')->on('priorities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
