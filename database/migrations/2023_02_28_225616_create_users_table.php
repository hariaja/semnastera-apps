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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('unique_id')->unique();
      $table->string('first_name');
      $table->string('last_name');
      $table->string('first_title')->nullable();
      $table->string('last_title')->nullable();
      $table->string('email')->unique();
      $table->string('phone')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('avatar', 190)->nullable();
      $table->tinyInteger('status')->default(0);
      $table->text('address');
      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
