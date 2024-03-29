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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('system_name', 50);
            $table->string('owner_name', 30);
            $table->string('system_pic', 30);
            $table->date('start_date');
            $table->integer('duration');
            $table->date('end_date');
            $table->string('status', 30);
            $table->string('development_methodology', 30);
            $table->string('system_platform', 30);
            $table->string('deployment_type', 30);
            $table->string('request_type', 30);
            $table->tinyInteger('approved')->default(0);
            $table->foreignId('leader_developer_id')->constrained('developers')->cascadeOnDelete();
            $table->foreignId('system_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
