<div class="container">
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md"></div>
        <form class="col-md text-center" action="<?= base_url('report/create_report') ?>" method="post">
            <div class="row">
                <select name="month_year" id="month_year" class="form-control select col-md mx-1">
                    <option value="">-- MM/YYYY --</option>
                    <?php
                    $current_year = date("Y");
                    $current_month = date("m");

                    $start_year = 2025;
                    $start_month = 1;

                    $year = $start_year;
                    $month = $start_month;

                    while ($year < $current_year || ($year == $current_year && $month <= $current_month)) {
                        if ($month == 1) $month_text = 'Januari';
                        else if ($month == 2) $month_text = 'Februari';
                        else if ($month == 3) $month_text = 'Maret';
                        else if ($month == 4) $month_text = 'April';
                        else if ($month == 5) $month_text = 'Mei';
                        else if ($month == 6) $month_text = 'Juni';
                        else if ($month == 7) $month_text = 'Juli';
                        else if ($month == 8) $month_text = 'Agustus';
                        else if ($month == 9) $month_text = 'September';
                        else if ($month == 10) $month_text = 'Oktober';
                        else if ($month == 11) $month_text = 'November';
                        else if ($month == 12) $month_text = 'Desember';
                    ?>
                        <option value="<?= $month . '/' . $year ?>"><?= $month_text . '/' . $year ?></option>
                    <?php
                        // increment bulan
                        $month++;
                        if ($month > 12) {
                            $month = 1;
                            $year++;
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">
                    <strong>Generate Report</strong>
                </button>
            </div>
        </form>
    </div>
</div>

<table class="mb-3 mt-2 table table text-center align-middle" id="table-print">
    <thead>
        <tr>
            <th rowspan="2" class="col-sm-2 border bg-white">Periode</th>
            <th colspan="3" class="border">Pendapatan</th>
            <th colspan="2" class="border">Paket</th>
            <th class="col-sm-2 border bg-white" rowspan="2">Jumlah Customer</th>
            <th class="col-sm-1 border" rowspan="2">Created Date</th>
        </tr>
        <tr>
            <th class="border">Tarif Terbentuk</th>
            <th class="border bg-white">Total Bayar</th>
            <th class="border">Sisa Tagihan</th>
            <th class="border bg-white">Paket Terkirim</th>
	        <th class="border">Paket Hilang</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($reports)) { ?>
            <?php foreach ($reports as $report) : ?>
                <?php
                $tanggal = date('M-Y', strtotime($report['tahun'] . '-' . $report['bulan']));
                // $tanggal = $report['']
                ?>
                <tr>
                    <td class="border border-1 bg-white"><?= $tanggal ?></td>
                    <td class="border border-1">Rp.<?= $report['ttl_tarif_terbentuk_formatted'] ?></td>
                    <td class="border border-1 bg-white">Rp.<?= $report['ttl_tarif_dibayar_formatted'] ?></td>
                    <td class="border border-1">Rp.<?= $report['ttl_tarif_blm_dibayar_formatted'] ?></td>
                    <td class="border border-1 bg-white"><?= $report['jml_paket_terkirim'] ?></td>
                    <td class="border border-1"><?= $report['jml_paket_hilang'] ?></td>
                    <td class="border border-1 bg-white"><?= $report['ttl_customer'] ?></td>
		            <td class="border border-1"><?= date('d-M-y', strtotime($report['created_at'])) ?></td>
            <?php endforeach; ?>
        <?php } else { ?>
            <tr class="border bg-white">
                <td colspan="100">belum ada data</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="text-center">
    <button type="button" onclick="print()" class="btn btn-outline-primary">Download As PDF</button>
</div>

<style>
    th[rowspan] {
        vertical-align: middle !important;
    }
</style>
