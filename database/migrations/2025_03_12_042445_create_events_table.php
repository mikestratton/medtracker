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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('medication_administration_id');
            $table->foreign('medication_administration_id')->references('id')
                ->on('medication_administrations')->onDelete('cascade');

            $table->boolean('has_taken_medication')->default(false);
            $table->string('note')->nullable();
            $table->date('date');
            $table->time('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key
            $table->dropForeign(['medication_administration_id']); // Drop the foreign key
        });

        Schema::dropIfExists('events');
    }
};
