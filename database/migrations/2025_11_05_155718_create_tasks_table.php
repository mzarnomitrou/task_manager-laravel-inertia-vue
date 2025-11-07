<?php

use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('status', ['pending', 'in progress', 'done'])->default('pending');
            $table->foreignIdFor(Project::class)->cascadeOnDelete();;
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->date('due_date')->nullable();
            $table->timestamps();
            $table->index([ 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
