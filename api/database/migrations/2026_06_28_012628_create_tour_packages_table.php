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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->string('title', 200);
            $table->enum('type', ['open_trip', 'private_tour']);
            $table->decimal('price', 12, 2);
            $table->decimal('price_original', 12, 2)->nullable();
            $table->integer('duration_days');
            $table->text('description')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('review_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
