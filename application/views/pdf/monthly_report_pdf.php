<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan - <?= $report['bulan'] ?>/<?= $report['tahun'] ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 20px;
            margin-bottom: 5px;
            color: #1a73e8;
        }
        .header h2 {
            font-size: 16px;
            font-weight: normal;
            color: #666;
        }
        .info-section {
            margin-bottom: 25px;
        }
        .info-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #1a73e8;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
        }
        .info-table td:first-child {
            width: 40%;
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .info-table td:last-child {
            text-align: right;
        }
        .highlight-green {
            color: #28a745;
            font-weight: bold;
        }
        .highlight-red {
            color: #dc3545;
            font-weight: bold;
        }
        .highlight-blue {
            color: #1a73e8;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .summary-box {
            background-color: #e8f4fd;
            border: 1px solid #1a73e8;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .summary-box .total {
            font-size: 18px;
            font-weight: bold;
            color: #1a73e8;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LACAK LOGISTIK</h1>
        <h2>Laporan Bulanan</h2>
        <p style="margin-top: 10px; font-size: 14px;">
            <strong>Periode: <?= $month_name ?> <?= $report['tahun'] ?></strong>
        </p>
    </div>

    <div class="summary-box">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center; width: 33%;">
                    <div style="font-size: 10px; color: #666;">Total Tarif Terbentuk</div>
                    <div class="total">Rp <?= number_format($report['ttl_tarif_terbentuk'], 0, ',', '.') ?></div>
                </td>
                <td style="text-align: center; width: 33%;">
                    <div style="font-size: 10px; color: #666;">Total Dibayar</div>
                    <div class="total" style="color: #28a745;">Rp <?= number_format($report['ttl_tarif_dibayar'], 0, ',', '.') ?></div>
                </td>
                <td style="text-align: center; width: 33%;">
                    <div style="font-size: 10px; color: #666;">Sisa Tagihan</div>
                    <div class="total" style="color: #dc3545;">Rp <?= number_format($report['ttl_tarif_blm_dibayar'], 0, ',', '.') ?></div>
                </td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Detail Pendapatan</h3>
        <table class="info-table">
            <tr>
                <td>Tarif Terbentuk</td>
                <td class="highlight-blue">Rp <?= number_format($report['ttl_tarif_terbentuk'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Total Dibayar</td>
                <td class="highlight-green">Rp <?= number_format($report['ttl_tarif_dibayar'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Sisa Tagihan</td>
                <td class="highlight-red">Rp <?= number_format($report['ttl_tarif_blm_dibayar'], 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Statistik Pengiriman</h3>
        <table class="info-table">
            <tr>
                <td>Paket Terkirim</td>
                <td class="highlight-green"><?= $report['jml_paket_terkirim'] ?> paket</td>
            </tr>
            <tr>
                <td>Paket Hilang</td>
                <td class="highlight-red"><?= $report['jml_paket_hilang'] ?> paket</td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Statistik Customer</h3>
        <table class="info-table">
            <tr>
                <td>Jumlah Customer Baru</td>
                <td class="highlight-blue"><?= $report['ttl_customer'] ?> customer</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Laporan dibuat pada: <?= date('d/m/Y H:i:s') ?></p>
        <p>Data untuk periode <?= $month_name ?> <?= $report['tahun'] ?> - Dibuat pada <?= date('d/m/Y', strtotime($report['created_at'])) ?></p>
        <p>&copy; <?= date('Y') ?> Lacak Logistik - Sistem Pelacakan Pengiriman</p>
    </div>
</body>
</html>
