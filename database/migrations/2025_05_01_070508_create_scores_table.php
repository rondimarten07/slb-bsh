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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->string('semester')->nullable();
            $table->string('year')->nullable();
            $table->string('nisn')->nullable();
            $table->string('spiritual_attitude')->nullable();
            $table->string('social_attitude')->nullable();

            $table->integer('religion_knowledge')->nullable();
            $table->integer('religion_skill')->nullable();
            $table->integer('nation_knowledge')->nullable();
            $table->integer('nation_skill')->nullable();
            $table->integer('indonesia_knowledge')->nullable();
            $table->integer('indonesia_skill')->nullable();
            $table->integer('math_knowledge')->nullable();
            $table->integer('math_skill')->nullable();
            $table->integer('english_knowledge')->nullable();
            $table->integer('english_skill')->nullable();
            $table->integer('science_knowledge')->nullable();
            $table->integer('science_skill')->nullable();
            $table->integer('social_knowledge')->nullable();
            $table->integer('social_skill')->nullable();
            
            $table->integer('art_knowledge')->nullable();
            $table->integer('art_skill')->nullable();
            $table->integer('sport_knowledge')->nullable();
            $table->integer('sport_skill')->nullable();
            $table->integer('local_wisdom_knowledge')->nullable();
            $table->integer('local_wisdom_skill')->nullable();
            
            $table->string('interest_subject')->nullable();
            $table->integer('interest_knowledge')->nullable();
            $table->integer('interest_skill')->nullable();
            
            $table->string('independence_subject')->nullable();
            $table->integer('independence_knowledge')->nullable();
            $table->integer('independence_skill')->nullable();

            $table->integer('extraordinary_knowledge')->nullable();
            $table->integer('extraordinary_skill')->nullable();

            $table->integer('sick')->nullable();
            $table->integer('permission')->nullable();
            $table->integer('absent')->nullable();

            $table->foreignId('user_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
