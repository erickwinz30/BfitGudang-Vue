<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class StockLog extends Model
{
  use HasFactory, HasUuids;

  protected $with = ['stock'];

  protected $fillable = [
    'stock_id',
    'amount',
    'status',
    'description',
  ];

  public function stock()
  {
    return $this->belongsTo(Stock::class);
  }
}
