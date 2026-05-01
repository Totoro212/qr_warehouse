<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockMovementController extends Controller
{

    public function index(Request $request)
    {
        $query = StockMovement::with(['product', 'user'])->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('product')) {
            $query->where('product_id', $request->product);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $movements = $query->paginate(20)->withQueryString();
        $products = Product::latest('updated_at')->get();

        return view('movements.index', compact('movements', 'products'));
    }


    public function create(Request $request)
    {
        $products = Product::orderBy('name')->get();
        $selectedProduct = $request->product_id ? Product::find($request->product_id) : null;

        return view('movements.create', compact('products', 'selectedProduct'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:100',
        ], [
            'note.max' => 'Примечание не должно превышать 100 символов.'
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($validated['type'] === 'out' && $product->quantity < $validated['quantity']) {
            return back()->withInput()->withErrors([
                'quantity' => 'Недостаточно товара на складе. Доступно: ' . $product->quantity
            ]);
        }

        StockMovement::create([
            'product_id' => $validated['product_id'],
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'note' => $validated['note'] ?? null,
        ]);

        if ($validated['type'] === 'in') {
            $product->increment('quantity', $validated['quantity']);
        } else {
            $product->decrement('quantity', $validated['quantity']);
        }

        return redirect()->route('movements.index')->with('success', 'Операция записана!');
    }
}
