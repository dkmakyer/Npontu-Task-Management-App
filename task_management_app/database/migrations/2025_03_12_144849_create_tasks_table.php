<?php

use App\Models\User;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->enum('category', ['Educational', 'Health and Fitness']);
            $table->boolean('completed')->default(false);
            $table->enum('priority', ['low', 'high', 'medium'])->default('low');
            $table->string('image_url')->nullable();
            $table->timestamp('due_date')->nullable(false);
            $table->timestamp('date_completed')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
