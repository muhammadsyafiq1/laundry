<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        .container{
            margin:0 auto;
            margin-top:35px;
            padding:40px;
            width:750px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:740px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:185px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <caption>
                {{$transaksi_detail->laundry->nama_laundry}}
            </caption>
            <thead>
                <tr>
                    <th colspan="3">Invoice <strong>#{{$transaksi_detail->transaction->transaksi_code}}</strong></th>
                    <th>{{ $transaksi_detail->created_at->format('D, d M Y') }}</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Laundry: </h4>
                        <p>{{$transaksi_detail->laundry->nama_laundry}}.<br>
                            {{$transaksi_detail->laundry->alamat_laundry}}<br>
                            {{$transaksi_detail->laundry->hp_laundry}}<br>
                            {{$transaksi_detail->laundry->user->email}}
                        </p>
                    </td>
                    <td colspan="2">
                        <h4>Pelanggan: </h4>
                        <p>{{$transaksi_detail->transaction->user->name}}<br>
                        {{$transaksi_detail->transaction->alamat_jemput}}<br>
                        {{ $transaksi_detail->transaction->user->phone }} <br>
                        {{ $transaksi_detail->transaction->user->email }}
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Produk</th>
                    <th>Harga / Kg</th>
                    <th>Berat</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <td>{{$transaksi_detail->transaction->pilihan_laundry}}</td>
                    <td>{{$transaksi_detail->total_harga}}</td>
                    <td>{{$transaksi_detail->transaction->kilo}} Kg</td>
                    <td>Rp {{ $transaksi_detail->total_harga }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <td>Rp {{ $transaksi_detail->total_harga }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>