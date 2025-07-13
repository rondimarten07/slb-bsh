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
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('originalname');
            $table->string('alt_text')->nullable();
            $table->string('mimetype')->nullable();
            $table->string('encoding')->nullable();
            $table->string('path')->nullable();
            $table->string('destination');
            $table->string('size')->nullable();
            $table->string('aux')->nullable();
            $table->string('uploader_id')->nullable();
            $table->unsignedBigInteger('object_id')->nullable();
            $table->string('object_type')->nullable()->comment('Model Namespace, i.e. App\Models\User');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_uploads');
    }
};
