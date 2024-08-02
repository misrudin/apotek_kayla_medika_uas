<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            img {
                max-width: 40px;
                max-height: 40px;
            }

        </style>
    </head>

    <body>
        <h1>Product Report</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->photo)
                                <img src="{{ storage_path('app/public/' . $product->photo) }}"
                                    alt="{{ $product->name }}"
                                    onerror="this.src='data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=';">
                            @else
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAB0lEQVR42mP8/wcAAwAB/UM6AAAAAElFTkSuQmCC"
                                    alt="Placeholder">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>Rp
                            {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td>{{ number_format($product->stock, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
