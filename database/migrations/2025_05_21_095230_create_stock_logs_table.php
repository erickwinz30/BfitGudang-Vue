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
    Schema::create('stock_logs', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('stock_id')->constrained('stocks');
      $table->integer('amount');
      $table->string('status');
      $table->text('description')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('stock_logs');
  }
};
