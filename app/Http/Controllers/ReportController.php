<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use PDF;

class ReportController extends Controller
{
    public function transactionPDF()
    {
        // Fetch transactions with related products
        $transactions = Transaction::with('product')->get();

        // Load the view and pass the transactions data
        $pdf = PDF::loadView('transactions.pdf', compact('transactions'));

        // Return the PDF for download
        return $pdf->download('transactions_report.pdf');
    }

    public function productPDF()
    {
        $products = Product::all();

        $pdf = PDF::loadView('products.pdf', compact('products'));

        return $pdf->stream('products_report.pdf');
    }
}
