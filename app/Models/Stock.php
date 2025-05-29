<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  use HasFactory, HasUuids;

  // protected $keyType = 'string';
  // protected $guarded = ['id'];

  protected $fillable = [
    'code',
    'name',
    'weight',
    'lead_time',
    'demand',
    'highest_sales',
    'longest_lead_time',
    'stock',
    'safety_stock',
    'reorder_point',
  ];

  public function stockLogs()
  {
    return $this->hasMany(StockLog::class);
  }
}
