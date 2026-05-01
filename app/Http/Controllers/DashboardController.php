<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('quantity');
        $lowStockCount = Product::whereRaw('quantity <= min_quantity')->count();
        $totalValue = Product::sum(DB::raw('price * quantity'));

        $lowStockProducts = Product::whereRaw('quantity <= min_quantity')
            ->orderBy('quantity', 'asc')
            ->limit(5)
            ->get();

        $categories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit(5)
            ->get();

        $totalCategories = Category::count();

        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'lowStockCount',
            'totalValue',
            'lowStockProducts',
            'categories',
            'totalCategories'
        ));
    }
}
