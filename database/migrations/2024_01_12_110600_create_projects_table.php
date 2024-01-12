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
            $table->string('system_name');
            $table->string('bu_name');
            $table->string('system_pic');
            $table->date('start_date');
            $table->integer('duration');
            $table->date('end_date');
            $table->string('status');
            $table->string('development_methodology');
            $table->string('system_platform');
            $table->string('deployment_type');
            $table->string('request_status');
            $table->foreignId('leader_developer_id')->nullable()->constrained('developers')->cascadeOnDelete();
            $table->foreignId('system_id')->nullable()->constrained()->cascadeOnDelete();
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
