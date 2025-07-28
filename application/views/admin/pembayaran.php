<div class="container">

    <form action="<?= base_url('superadmin/bayar_view') ?>" method="post">

        <div class="card rounded-0 mb-4">
            <div class="card-body">

                <hr class="mt-1">

                <div class="row justify-content-center align-items-center mb-3">
                    <div class="col-md-2">
                        <label for="id_pengiriman" class="form-label"><strong>No. Resi</strong></label>
                    </div>
                    <div class="col-md">
                        <select name="id_pengiriman" id="id_pengiriman" class="select form-control rounded-0">
                            <option value="">-- Nomor Pengiriman --</option>
                            <?php foreach ($data_kirim as $data) : ?>
                                <option value="<?= $data['no_resi'] ?>"><?= $data['no_resi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <hr class="mt-1">

                <div class="row justify-content-center align-items-center mb-3">
                    <div class="col-md-2">
                        <label for="nama_pengirim" class="form-label"><strong>Nama Pengirim</strong></label>
                    </div>
                    <div class="col-md">
                        <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control rounded-0" readonly>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center mb-3">
                    <div class="col-md-2">
                        <label for="nama_penerima" class="form-label"><strong>Nama Penerima</strong></label>
                    </div>
                    <div class="col-md">
                        <input type="text" name="nama_penerima" id="nama_penerima" class="form-control rounded-0" readonly>
                    </div>
                </div>

                <hr class="mt-1">

                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label for="kategori" class="form-label"><strong>Kategori</strong></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="kategori" id="kategori" class="form-control rounded-0" readonly>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label for="tipe_kurir" class="form-label"><strong>Tipe Kurir</strong></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="tipe_kurir" id="tipe_kurir" class="form-control rounded-0" readonly>
                    </div>
                </div>

                <hr class="mt-1">

                <div class="row align-items-center mb-3">
                    <div class="col-md row mx-0 px-0 align-items-center">
                        <div class="col-md-4">
                            <label for="harga" class="form-label"><strong>Total Biaya (Rp.)</strong></label>
                        </div>
                        <div class="col-md">
                            <input type="text" name="harga" id="harga" class="form-control rounded-0" readonly>
                        </div>
                    </div>
                    <div class="col-md row mx-0 px-0 align-items-center">
                        <div class="col-md-4">
                            <label for="total_bayar_display" class="form-label"><strong>Total Bayar (Rp.)</strong></label>
                        </div>
                        <div class="col-md">
                            <input type="text" id="total_bayar_display" class="form-control rounded-0">
                            <input type="hidden" id="total_bayar" name="total_bayar">
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md row mx-0 px-0 align-items-center">
                        <div class="col-md-4">
                            <label for="metode_bayar" class="form-label"><strong>Metode Bayar</strong></label>
                        </div>
                        <div class="col-md">
                            <select name="metode_bayar" id="metode_bayar" class="form-control rounded-0">
                                <option value="">-- metode pembayaran --</option>
                                <?php foreach ($metode_bayar as $metode) : ?>
                                    <option value="<?= $metode['ID'] . '.' . $metode['is_card'] ?>" data-is_card="<?= $metode['is_card'] ?>"><?= $metode['metode'] . ' [' . $metode['bank'] . ']' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- akan dimunculkan kalau pilihannya adalah DC / CC -->
                    <div class="col-md row mx-0 px-0 align-items-center">
                        <div class="col-md-4">
                            <label for="nomor_kartu" class="form-label"><strong>No. Kartu</strong></label>
                        </div>
                        <div class="col-md">
                            <input type="text" name="nomor_kartu" id="nomor_kartu" class="form-control rounded-0">
                        </div>
                    </div>
                </div>

                <hr class="mt-1 mb-1 mb-3">

                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label for="atas_nama_bayar" class="form-label"><strong>Dibayar Oleh</strong></label>
                    </div>
                    <div class="col-md">
                        <input type="text" placeholder="Atas Nama Kwitansi (required)" name="atas_nama_bayar" id="atas_nama_bayar" class="form-control rounded-0" required>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md">
                        <div class="row">
                            <div class="col-sm">Kembalian:</div>
                            <div class="col-sm"><input type="text" id="kembalian" class="form-control border-0 bg-light" disabled></div>
                            <input type="hidden" name="kembalian" id="kembalian_post">
                        </div>
                    </div>
                    <div class="col-md"></div>
                    <div class="col-md text-right">
                        <input type="reset" value="reset" class="btn btn-secondary">
                        <input type="submit" value="selesai" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

<script>
    $(document).ready(function() {
        $('.select').select2();

        $('#id_pengiriman').change(function() {
            let noResi = $(this).val();

            if (noResi) {
                $.ajax({
                    url: "<?= base_url('superadmin/get_data_pengiriman') ?>",
                    method: "POST",
                    data: {
                        id_pengiriman: noResi
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#nama_pengirim').val(response.sender_name);
                        $('#nama_penerima').val(response.nama_penerima);
                        $('#kategori').val(response.nama_kategori);
                        $('#tipe_kurir').val(response.tipe_kurir);
                        $('#harga').val(response.biaya_total_view);
                    },
                    error: function() {
                        alert("Gagal mengambil data. Pastikan server jalan dan endpoint benar.");
                    }
                });
            } else {
                // reset form
                $('#nama_pengirim, #nama_penerima, #kategori, #tipe_kurir, #harga').val('');
            }
        });
    });

    $('#metode_bayar').change(function() {
        const selected = $(this).find('option:selected');
        const isCard = selected.data('is_card');

        if (isCard == 1) {
            $('#nomor_kartu').prop('disabled', false); // enable input
            $('#nomor_kartu').prop('required', true); // wajib diisi
        } else {
            $('#nomor_kartu').prop('disabled', true).val(''); // disable & clear
            $('#nomor_kartu').prop('required', false); // tidak wajib
        }
    });


    // Set kondisi default saat load awal
    $('#nomor_kartu').prop('disabled', true);

    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('total_bayar_display');
        const hiddenInput = document.getElementById('total_bayar');
        const hargaInput = document.getElementById('harga');
        const kembalianInput = document.getElementById('kembalian');
        const kembalian_post = document.getElementById('kembalian_post');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function hitungKembalianDanSetTotalBayar() {
            const harga = parseInt(hargaInput.value.replace(/\D/g, '') || 0);
            const totalBayarUser = parseInt(displayInput.value.replace(/\D/g, '') || 0);
            const selisih = totalBayarUser - harga;

            // Format kembalian (boleh negatif)
            const formattedSelisih = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(selisih);
            kembalianInput.value = formattedSelisih;

            if (selisih < 0) {
                kembalian_post.value = selisih * (-1);
            } else {
                kembalian_post.value = 0;
            }

            // Tentukan total_bayar (yang akan di-submit)
            if (totalBayarUser >= harga) {
                hiddenInput.value = harga; // bayar lunas atau lebih
            } else {
                hiddenInput.value = totalBayarUser; // bayar sebagian (hutang)
            }
        }

        displayInput.addEventListener('input', function() {
            const raw = displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            displayInput.value = formatRupiah(raw);
            hitungKembalianDanSetTotalBayar();
        });
    });
</script>