<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            // who applied
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // to which job
            $table->foreignId('job_id')->constrained()->cascadeOnDelete();

            // simple fields for now
            $table->text('message')->nullable();
            $table->string('cv_url')->nullable(); // link to CV (no file upload yet)

            // you can add status later: pending/accepted/rejected
            // $table->string('status')->default('pending');

            $table->timestamps();

            // prevent same user applying twice to same job
            $table->unique(['user_id', 'job_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
