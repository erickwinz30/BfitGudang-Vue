<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    \App\Models\User::factory()->create([
      'name' => 'Admin',
      'username' => 'admin',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('admin123'),
    ]);

    Stock::create([
      'code' => 'STK001',
      'name' => 'Stock A',
      'weight' => 20,
      'lead_time' => 5,
      'demand' => 100,
      'highest_sales' => 150,
      'longest_lead_time' => 10,
      'stock' => 200,
      'safety_stock' => 30,
      'reorder_point' => 50,
    ]);

    Stock::create([
      'code' => 'STK002',
      'name' => 'Stock B',
      'weight' => 30,
      'lead_time' => 7,
      'demand' => 200,
      'highest_sales' => 250,
      'longest_lead_time' => 12,
      'stock' => 300,
      'safety_stock' => 30,
      'reorder_point' => 70,
    ]);

    Stock::create([
      'code' => 'STK003',
      'name' => 'Stock C',
      'weight' => 40,
      'lead_time' => 10,
      'demand' => 300,
      'highest_sales' => 350,
      'longest_lead_time' => 15,
      'stock' => 400,
      'safety_stock' => 30,
      'reorder_point' => 90,
    ]);

    Stock::create([
      'code' => 'STK004',
      'name' => 'Stock D',
      'weight' => 50,
      'lead_time' => 12,
      'demand' => 400,
      'highest_sales' => 450,
      'longest_lead_time' => 20,
      'stock' => 500,
      'safety_stock' => 30,
      'reorder_point' => 110,
    ]);
  }
}
