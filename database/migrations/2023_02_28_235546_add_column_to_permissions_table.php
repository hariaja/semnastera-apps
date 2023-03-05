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
    Schema::table('permissions', function (Blueprint $table) {
      $table->unsignedBigInteger('permission_category_id')->after('id')->nullable();
      $table->foreign('permission_category_id')->references('id')->on('permission_categories')->onDelete('cascade');
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('permissions', function (Blueprint $table) {
      $table->dropForeign('permissions_permission_category_id_foreign');
      $table->dropColumn('permission_category_id');
    });
  }
};
