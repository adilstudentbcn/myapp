<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->string('logo_path')
                ->nullable()
                ->after('name'); // adjust position if you want
        });
    }

    public function down(): void
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn('logo_path');
        });
    }
};
