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
    Schema::create('stocks', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('code')->unique();
      $table->string('name');
      $table->double('weight');
      $table->integer('lead_time');
      $table->integer('demand');
      $table->integer('highest_sales');
      $table->integer('longest_lead_time');
      $table->integer('stock');
      $table->integer('safety_stock');
      $table->integer('reorder_point');
      $table->boolean('is_deleted')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('stocks');
  }
};
