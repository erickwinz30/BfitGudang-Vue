<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
  public function entriesIndex()
  {
    try {
      $getLogs = StockLog::whereIn('status', ['Baru', 'Retur'])->latest()->get();

      $logs = $getLogs->map(function ($log) {
        return [
          'id' => $log->id,
          'name' => $log->stock->name,
          'code' => $log->stock->code,
          'amount' => $log->amount,
          'status' => $log->status,
          'description' => $log->description,
          'created_at' => $log->created_at->format('Y-m-d H:i:s'),
        ];
      });

      return Inertia::render('Admin/Logs/EntriesLog', [
        'logs' => $logs,
      ]);
    } catch (\Exception $e) {
      Log::error('Error fetching stock logs: ' . $e->getMessage());
    }
  }

  public function reduceIndex()
  {
    try {
      $getLogs = StockLog::whereIn('status', ['Terjual', 'Cabang'])->latest()->get();

      $logs = $getLogs->map(function ($log) {
        return [
          'id' => $log->id,
          'name' => $log->stock->name,
          'code' => $log->stock->code,
          'amount' => $log->amount,
          'status' => $log->status,
          'description' => $log->description,
          'created_at' => $log->created_at->format('Y-m-d H:i:s'),
        ];
      });

      return Inertia::render('Admin/Logs/ReduceLog', [
        'logs' => $logs,
      ]);
    } catch (\Exception $e) {
      Log::error('Error fetching stock logs: ' . $e->getMessage());
    }
  }
}
