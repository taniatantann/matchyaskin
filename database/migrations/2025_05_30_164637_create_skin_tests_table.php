<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skin_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('result_skin_type', 10); // contoh e DRPT, OSNT
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skin_tests');
    }
};
