<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - <?= $invoice['no_resi'] ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #1a73e8;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 22px;
            margin-bottom: 5px;
            color: #1a73e8;
        }
        .header p {
            color: #666;
            font-size: 10px;
        }
        .invoice-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-title h2 {
            font-size: 18px;
            background-color: #1a73e8;
            color: white;
            padding: 10px;
            display: inline-block;
        }
        .invoice-info {
            margin-bottom: 20px;
        }
        .invoice-info table {
            width: 100%;
        }
        .invoice-info td {
            padding: 3px 0;
            vertical-align: top;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 8px 10px;
            margin-bottom: 10px;
            border-left: 4px solid #1a73e8;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
        }
        .data-table td:first-child {
            width: 35%;
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .two-column {
            width: 100%;
            margin-bottom: 15px;
        }
        .two-column td {
            width: 50%;
            vertical-align: top;
            padding: 0 5px;
        }
        .two-column td:first-child {
            padding-left: 0;
        }
        .two-column td:last-child {
            padding-right: 0;
        }
        .total-box {
            background-color: #e8f4fd;
            border: 2px solid #1a73e8;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }
        .total-box .label {
            font-size: 12px;
            color: #666;
        }
        .total-box .amount {
            font-size: 20px;
            font-weight: bold;
            color: #1a73e8;
        }
        .lunas-stamp {
            text-align: center;
            margin: 20px 0;
        }
        .lunas-stamp .stamp {
            display: inline-block;
            border: 3px solid #28a745;
            color: #28a745;
            padding: 10px 30px;
            font-size: 24px;
            font-weight: bold;
            transform: rotate(-5deg);
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .signature-section {
            margin-top: 30px;
        }
        .signature-section table {
            width: 100%;
        }
        .signature-section td {
            text-align: center;
            padding: 10px;
            vertical-align: top;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LACAK LOGISTIK</h1>
        <p>Jasa Pengiriman Barang Terpercaya</p>
    </div>

    <div class="invoice-title">
        <h2>INVOICE / BUKTI PEMBAYARAN</h2>
    </div>

    <div class="invoice-info">
        <table>
            <tr>
                <td style="width: 50%;">
                    <strong>No. Resi:</strong> <?= $invoice['no_resi'] ?><br>
                    <strong>Tanggal Kirim:</strong> <?= date('d/m/Y', strtotime($invoice['tanggal_diserahkan'])) ?>
                </td>
                <td style="width: 50%; text-align: right;">
                    <strong>Tanggal Cetak:</strong> <?= date('d/m/Y H:i') ?><br>
                    <?php if (!empty($invoice['tanggal_diterima'])) : ?>
                    <strong>Tanggal Diterima:</strong> <?= date('d/m/Y', strtotime($invoice['tanggal_diterima'])) ?>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

    <table class="two-column">
        <tr>
            <td>
                <div class="section">
                    <div class="section-title">DATA PENGIRIM</div>
                    <table class="data-table">
                        <tr>
                            <td>Nama</td>
                            <td><?= $invoice['sender_name'] ?></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="section">
                    <div class="section-title">DATA PENERIMA</div>
                    <table class="data-table">
                        <tr>
                            <td>Nama</td>
                            <td><?= $invoice['nama_penerima'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $invoice['alamat_tujuan'] ?></td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td><?= $invoice['kota_tujuan'] ?></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="section">
        <div class="section-title">DETAIL PAKET</div>
        <table class="data-table">
            <tr>
                <td>Kategori</td>
                <td><?= $invoice['nama_kategori'] ?></td>
            </tr>
            <tr>
                <td>Tipe Kurir</td>
                <td><?= $invoice['tipe_kurir'] ?></td>
            </tr>
            <tr>
                <td>Bobot</td>
                <td><?= $invoice['bobot'] ?> Kg</td>
            </tr>
            <tr>
                <td>Volume</td>
                <td><?= $invoice['volume'] ?> M³</td>
            </tr>
        </table>
    </div>

    <div class="total-box">
        <div class="label">TOTAL BIAYA PENGIRIMAN</div>
        <div class="amount">Rp <?= number_format($invoice['biaya_total'], 0, ',', '.') ?></div>
    </div>

    <div class="lunas-stamp">
        <div class="stamp">L U N A S</div>
    </div>

    <div class="signature-section">
        <table>
            <tr>
                <td style="width: 50%;">
                    <p>Pengirim,</p>
                    <div class="signature-line">
                        <?= $invoice['sender_name'] ?>
                    </div>
                </td>
                <td style="width: 50%;">
                    <p>Hormat Kami,</p>
                    <div class="signature-line">
                        Lacak Logistik
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Invoice ini digenerate secara otomatis oleh sistem.</p>
        <p>&copy; <?= date('Y') ?> Lacak Logistik - Sistem Pelacakan Pengiriman</p>
    </div>
</body>
</html>
