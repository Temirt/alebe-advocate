<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('case_results', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('practice_area');
            $table->string('result_type');
            $table->date('date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('case_results'); }
};
