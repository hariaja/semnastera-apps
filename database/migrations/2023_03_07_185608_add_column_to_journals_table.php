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
    Schema::table('journals', function (Blueprint $table) {
      $table->string('status')->default('New Upload')->after('upload_year');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('journals', function (Blueprint $table) {
      $table->dropColumn('status');
    });
  }
};
