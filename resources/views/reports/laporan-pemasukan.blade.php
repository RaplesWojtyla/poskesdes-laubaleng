<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pemasukan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .download-button {
            position: absolute;
            top: 20px;
            right: 20px;
			padding: 10px;
			border-radius: 8px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>
<body>
    <h1>Laporan Pemasukan</h1>
    <button type="button" onclick="printAsPDF()" class="download-button">Download as PDF</button>
    <table>
        <thead>
            <tr>
                <th>Kode Invoice</th>
                <th>Transaksi Selesai</th>
                <th>Transaksi</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
			@php 
				$total = 0;
				$tipeTransaksi = '';
				$paymentMethod = '';
			@endphp
            @foreach ($orders as $order)
			@php 
				$total += $order->total_invoice_price ;

				if($order->order_status != 'Offline') $tipeTransaksi = 'Online';
				else $tipeTransaksi = 'Offline';

				if ($order->recipient_payment == 'other_qris') $paymentMethod = 'QRIS';
				else $paymentMethod = strtoupper(str_replace('_', ' ', $order->recipient_payment));
			@endphp
			
                <tr>
                    <td>{{ $order->invoice_code }}</td>
                    <td>{{ date('d M Y',strtotime($order->order_completed)) }}</td>
                    <td><strong>{!! $tipeTransaksi !!}</strong></td>
                    <td><strong>{!! $paymentMethod !!}</strong></td>
                    <td>Rp {{ number_format($order->total_invoice_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: center;"><strong>Total Pemasukan:</strong></td>
                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

	<script>
		function printAsPDF() {
			const filename = 'laporan-pemasukan.pdf';

			html2pdf(document.body, {
				filename: filename,
				html2canvas: { scale: 3 },
				jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
			});
		}
	</script>
</body>
</html>
