<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $stocks = Stock::where('is_deleted', false)->get();

    return Inertia::render('Admin/Index', [
      'stocks' => $stocks,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return Inertia::render('Admin/Stocks/Create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:255|unique:stocks,code',
        'weight' => 'required|integer|min:0',
        'lead_time' => 'required|integer|min:0',
        'demand' => 'required|integer|min:0',
        'highest_sales' => 'required|integer|min:0',
        'longest_lead_time' => 'required|integer|min:0',
        'stock' => 'required|integer|min:0',
      ]);

      $lead_time = $validatedData['lead_time'];
      $demand = $validatedData['demand'];
      $highest_sales = $validatedData['highest_sales'];
      $longest_lead_time = $validatedData['longest_lead_time'];

      // $lead_time_demand = $lead_time * $demand;

      $safety_stock = ($highest_sales * $longest_lead_time) - ($lead_time * $demand);
      $reorder_point = ($lead_time * $demand) + $safety_stock;

      $validatedData['safety_stock'] = $safety_stock;
      $validatedData['reorder_point'] = $reorder_point;

      $stock = Stock::create($validatedData);

      Log::info('Stock created successfully', $validatedData);

      return Inertia::render('Admin/Index', [
        'status' => 'Stock created successfully',
        'stocks' => Stock::where('is_deleted', false)->get(),
      ]);
    } catch (\Exception $e) {
      Log::error('Error creating stock: ' . $e->getMessage());
      return Inertia::render('Admin/Stocks/Create', [
        'status' => 'Error creating stock: ' . $e->getMessage(),
      ]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Stock $stock)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Stock $stock)
  {
    try {
      return Inertia::render('Admin/Stocks/Edit', [
        'stock' => $stock,
      ]);
    } catch (\Exception $e) {
      Log::error('Error fetching stock for edit: ' . $e->getMessage());

      return Inertia::render('Admin/Stocks/Edit', [
        'status' => 'Error fetching stock for edit: ' . $e->getMessage(),
        'stock' => $stock,
      ]);
    }

    // return Inertia::render('Admin/Stocks/Edit', [
    //   'stock' => $stock,
    // ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Stock $stock)
  {
    try {
      $changeLeadTime = false;
      $changeDemand = false;
      $changeHighestSales = false;
      $changeLongestLeadTime = false;

      $rules = [];

      if ($request->name !== $stock->name) {
        $rules['name'] = 'required|string|max:255';
      }

      if ($request->code != $stock->code) {
        $rules['code'] = 'required|string|max:255|unique:stocks,code,' . $stock->id;
      }

      if ($request->weight != $stock->weight) {
        $rules['weight'] = 'required|integer|min:0';
      }

      if ($request->lead_time !== $stock->lead_time) {
        $rules['lead_time'] = 'required|integer|min:0';

        $changeLeadTime = true;
      }

      if ($request->demand !== $stock->demand) {
        $rules['demand'] = 'required|integer|min:0';

        $changeDemand = true;
      }

      if ($request->highest_sales != $stock->highest_sales) {
        $rules['highest_sales'] = 'required|integer|min:0';

        $changeHighestSales = true;
      }

      if ($request->longest_lead_time !== $stock->longest_lead_time) {
        $rules['longest_lead_time'] = 'required|integer|min:0';

        $changeLongestLeadTime = true;
      }

      if ($request->stock !== $stock->stock) {
        $rules['stock'] = 'required|integer|min:0';
      }

      $validatedData = $request->validate($rules);

      if ($changeLeadTime || $changeDemand || $changeHighestSales || $changeLongestLeadTime) {
        $lead_time = $validatedData['lead_time'] ?? $stock->lead_time;
        $demand = $validatedData['demand'] ?? $stock->demand;
        $highest_sales = $validatedData['highest_sales'] ?? $stock->highest_sales;
        $longest_lead_time = $validatedData['longest_lead_time'] ?? $stock->longest_lead_time;

        // Calculate safety stock and reorder point
        $safety_stock = ($highest_sales * $longest_lead_time) - ($lead_time * $demand);
        $reorder_point = ($lead_time * $demand) + $safety_stock;

        // Update validated data with calculated values
        $validatedData['safety_stock'] = $safety_stock;
        $validatedData['reorder_point'] = $reorder_point;
      }

      $stock->update($validatedData);
      Log::info('Stock updated successfully', $validatedData);

      return Inertia::render('Admin/Index', [
        'status' => 'Stock updated successfully',
        'stocks' => Stock::where('is_deleted', false)->get(),
      ]);
    } catch (\Exception $e) {
      Log::error('Error updating stock: ' . $e->getMessage());
      return Inertia::render('Admin/Stocks/Edit', [
        'status' => 'Error updating stock: ' . $e->getMessage(),
        'stock' => $stock,
      ]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Stock $stock)
  {
    try {
      $stock->is_deleted = true;
      $stock->save();

      Log::info('Stock deleted successfully', ['stock_id' => $stock->id]);

      return Inertia::render('Admin/Index', [
        'status' => 'Stock deleted successfully',
        'stocks' => Stock::where('is_deleted', false)->get(),
      ]);
    } catch (\Exception $e) {
      Log::error('Error deleting stock: ' . $e->getMessage());
      return Inertia::render('Admin/Index', [
        'status' => 'Error deleting stock: ' . $e->getMessage(),
        'stocks' => Stock::where('is_deleted', false)->get(),
      ]);
    }
  }
}
