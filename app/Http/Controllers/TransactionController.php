<?php

namespace App\Http\Controllers;

use App\Models\TransactionProduct;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query');

        $transactions = Transaction::with(['products.product'])
            ->where('customer_name', 'LIKE', "%{$query}%")
            ->orWhere('transaction_date', 'like', "%$query%")
            ->get()
            ->map(function($transaction) {
                $transaction->formatted_date = $transaction->transaction_date->format('d M Y, H:i');
                $transaction->total_amount = $transaction->products->sum('total');
                return $transaction;
            });

        return response()->json($transactions);
    }

    $transactions = Transaction::with('products.product')->get();

    return view('transactions.index', compact('transactions'));
}


    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $totalAmount = 0;

            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['product_id']);
                $totalAmount += $productData['quantity'] * $product->price;
            }

            $transaction = Transaction::create([
                'customer_name' => $request->customer_name,
                'total_amount' => $totalAmount,
            ]);

            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['product_id']);

                TransactionProduct::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productData['product_id'],
                    'quantity' => $productData['quantity'],
                    'price' => $product->price,
                    'total' => $productData['quantity'] * $product->price,
                ]);

                $product->stock -= $productData['quantity'];
                $product->save();
            }

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Data transaksi berhasil ditambahakan.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('transactions.index')->with('error', 'Gagal menambahkan transaksi.');
        }
    }


    public function show(Transaction $transaction)
    {
        $transaction = Transaction::with('products.product')->findOrFail($transaction->id);
        $transaction->formatted_date = $transaction->transaction_date->format('d M Y, H:i');
        $transaction->total_amount = $transaction->products->sum('total');

        return view('transactions.show', compact('transaction'));
    }
}
