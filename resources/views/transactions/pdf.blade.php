<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        h3 { margin: 0 0 10px 0; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="container">
        <h3>Laporan Transaksi</h3>

        @foreach($transactions as $transaction)
            <h4>Transaksi #{{ $transaction->id }}</h4>
            <table>
                <tr>
                    <th>ID Transaksi:</th>
                    <td>{{ $transaction->id }}</td>
                </tr>
                <tr>
                    <th>Nama Pelanggan:</th>
                    <td>{{ $transaction->customer_name }}</td>
                </tr>
                <tr>
                    <th>Tanggal:</th>
                    <td>{{ $transaction->formatted_date }}</td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td>{{ formatRupiah($transaction->total_amount) }}</td>
                </tr>
            </table>

            <h4>Detail Produk</h4>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->product->name }}</td>
                            <td>{{ formatRupiah($product->price) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ formatRupiah($product->total) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="page-break"></div>
        @endforeach
    </div>
</body>
</html>
