<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\Category;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::with('category');


        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                    ->orWhere('sku', 'ilike', "%{$search}%");
            });
        }


        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }


        if ($request->filled('low_stock') && $request->low_stock == '1') {
            $query->whereColumn('quantity', '<=', 'min_quantity');
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'sku' => 'nullable|string|unique:products',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'min_quantity' => 'required|integer|min:0',
            'location' => 'nullable|string',
        ]);


        if (empty($validated['sku'])) {
            do {
                $sku = 'PRD-' . strtoupper(substr(md5(uniqid()), 0, 6));
            } while (Product::where('sku', $sku)->exists());
            $validated['sku'] = $sku;
        }

        $product = Product::create($validated);

        $qrPath = 'qrcode/' . $product->sku . '.svg';
        $qrContent = QrCode::size(200)->generate(route('products.show', $product));

        if (!file_exists(public_path('qrcode'))) {
            mkdir(public_path('qrcode'), 0755, true);
        }
        file_put_contents(public_path($qrPath), $qrContent);
        $product->update(['qr_code' => $qrPath]);

        return redirect()->route('products.index')->with('success', 'Товар добавлен!');
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($product->id),
            ],
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'min_quantity' => 'required|integer|min:0',
            'location' => 'nullable|string',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Товар обновлен!');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар удалён!');
    }


    public function scanner()
    {
        return view('scanner');
    }


    public function findBySku($sku)
    {
        $product = Product::where('sku', $sku)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'url' => route('products.show', $product),
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Товар не найден'
        ], 404);
    }
}
