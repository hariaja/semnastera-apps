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
    Schema::create('revisions', function (Blueprint $table) {
      $table->id();
      $table->string('code')->unique()->nullable();
      $table->string('batch')->nullable();
      $table->foreignId('journal_id')->constrained('journals', 'id');
      $table->foreignId('revision_by')->constrained('users', 'id');
      $table->string('revision_file', 190);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('revisions');
  }
};
