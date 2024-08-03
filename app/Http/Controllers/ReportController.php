<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use PDF;

class ReportController extends Controller
{
    public function transactionPDF()
    {
        $transactions = Transaction::with('products.product')
        ->get()
        ->map(function($transaction) {
            $transaction->formatted_date = $transaction->transaction_date->format('d M Y, H:i');
            $transaction->total_amount = $transaction->products->sum('total');
            return $transaction;
        });

        $pdf = PDF::loadView('transactions.pdf', compact('transactions'));
        return $pdf->stream('transactions_report.pdf');
    }

    public function productPDF()
    {
        $products = Product::all();

        $pdf = PDF::loadView('products.pdf', compact('products'));

        return $pdf->stream('products_report.pdf');
    }
}
