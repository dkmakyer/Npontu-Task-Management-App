<?php

use App\Models\Collaborator;
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
        Schema::create('collaboration_notifications', function (Blueprint $table) {
            $table->id();
            $table->text('body')->nullable(false);
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade'); // this field refers to the one who sent the email 
            $table->string('receiver_email')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaboration_notifications');
    }
};
