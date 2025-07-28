<form class="container mb-3" action="<?= base_url('superadmin/kirim_paket') ?>" method="post" enctype="multipart/form-data">

    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php } ?>

    <div class="card rounded-0">
        <div class="card-body text-dark">

            <div class="row">
                <div class="col-md-1">
                    <label for="sender_ID"><strong>Data Pengirim</strong></label>
                </div>
                <div class="col-md">
                    <select name="sender_ID" id="sender_ID" class="form-control pilihan" <?= set_select('sender_ID', $customer['ID']) ?>>
                        <option value="">-- pilih customer --</option>
                        <?php foreach ($daftar_customer as $customer) : ?>
                            <option value="<?= $customer['ID'] ?>"><?= $customer['NamaLengkap'] ?> (<?= $customer['no_telp'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('sender_name', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary form-control" type="button" data-toggle="modal" data-target="#customerModal">&starf;</button>
                </div>
            </div>

            <hr class="mt-1">

            <div class="row">
                <div class="col-md-1">
                    <label for="receiver_name"><strong>Data Penerima</strong></label>
                </div>
                <div class="col-md">
                    <input type="text" name="receiver_name" value="<?= set_value('receiver_name') ?>" id="receiver_name" class="form-control" placeholder="Nama Lengkap" maxlength="255">
                    <?= form_error('receiver_name', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="col-md">
                    <input type="tel" name="receiver_telp" value="<?= set_value('receiver_telp') ?>" id="receiver_telp" class="form-control" placeholder="Nomor Telpon (format: 62xxxxxxxxxx)" maxlength="15">
                    <?= form_error('receiver_telp', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

            <hr class="mt-1">

            <div class="row">
                <div class="col-md-1">
                    <label for="kota_tujuan"><strong>Kota Tujuan</strong></label>
                </div>
                <div class="col-md">
                    <select name="kota_tujuan" id="kota_tujuan" class="form-control">
                        <!-- <option value="">-- Pilih Kota --</option> -->
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-1">
                    <label for="alamat_tujuan"><strong>Alamat Lengkap</strong></label>
                </div>
                <div class="col-md">
                    <textarea type="text" value="<?= set_value('alamat_tujuan') ?>" name="alamat_tujuan" id="alamat_tujuan" class="form-control" placeholder="Alamat Tujuan" rows="4"></textarea>
                    <?= form_error('alamat_tujuan', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

            <hr class="mt-1">

            <div class="row">
                <div class="col-md-1">
                    <label for="bobot"><strong>Data Paket</strong></label>
                </div>
                <div class="col-md">
                    <input type="text" class="form-control" id="bobot_display" placeholder="Bobot (gram)">
                    <?= form_error('bobot_display', '<div class="text-danger">', '</div>') ?>

                    <input type="hidden" name="bobot" id="bobot">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary form-control" type="button" data-toggle="modal" data-target="#volumeModal">Volume</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <label for="kategori"><strong>Kategori Paket</strong></label>
                </div>
                <div class="col-md">
                    <select name="kategori" id="kategori" class="form-control pilihan">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($list_kategori as $kategori) : ?>
                            <option value="<?= $kategori['ID'] ?>"><?= $kategori['Nama'] ?> <?= ($kategori['harga'] == 0) ? '' : '(extra +Rp.' . $kategori['harga_formatted'] . ')' ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('kategori', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <label for="tipe_kurir"><strong>Tipe Kurir</strong></label>
                </div>
                <div class="col-md">
                    <select name="tipe_kurir" id="tipe_kurir" class="form-control pilihan">
                        <option value="">-- Pilih Tipe Kurir --</option>
                        <?php foreach ($list_tipekurir as $tipekurir) : ?>
                            <option value="<?= $tipekurir['ID'] ?>"><?= $tipekurir['tipe'] . ' (' . $tipekurir['durasi_hari'] . ' hari) - Rp.' . $tipekurir['biaya_formatted'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <hr class="mt-1">

            <div class="row">
                <div class="col-md"></div>
                <div class="col-md"></div>
                <div class="col-md text-right">
                    <button type="submit" class="btn btn-primary">next &raquo;</button>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL VOLUME -->
    <div class="modal fade" id="volumeModal" tabindex="-1" aria-labelledby="Volume" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Volume Paket</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- panjang -->
                    <input type="text" class="form-control rounded-0 mb-3" id="panjang_display" placeholder="panjang (cm)">
                    <input type="hidden" name="panjang" id="panjang">

                    <!-- lebar -->
                    <input type="text" class="form-control rounded-0 mb-3" id="lebar_display" placeholder="lebar (cm)">
                    <input type="hidden" name="lebar" id="lebar">

                    <!-- tinggi -->
                    <input type="text" class="form-control rounded-0 mb-3" id="tinggi_display" placeholder="tinggi (cm)">
                    <input type="hidden" name="tinggi" id="tinggi">

                    <!-- volume -->
                    <div class="input-group mb-2">
                        <input type="number" min="0" maxlength="6" class="form-control rounded-0" readonly name="volume" id="volume" placeholder="Volume">
                        <div class="input-group-prepend">
                            <label for="volume" class="input-group-text"><b>cm<sup>3</sup></b></label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">save changes</button>
                </div>
            </div>
        </div>
    </div>

</form>

<!-- MODAL EXTEND -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="Volume" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-dark mb-0"><strong>&star; Perihal Customer Baru</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p class="text-dark">Menambah customer baru hanya dapat dilakukan secara mandiri oleh bersangkutan melalui <a href="<?= base_url('customer/registrasi') ?>">Link ini.</a></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">close</button>
            </div>
        </div>
    </div>
</div>

<script>
    /** fungsi formatting angka yang diinput dengan yang disubmit ke controller */

    /** bobot */
    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('bobot_display');
        const hiddenInput = document.getElementById('bobot');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        displayInput.addEventListener('input', function() {
            const raw = displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            displayInput.value = formatRupiah(raw);
            hiddenInput.value = raw;
        });
    });

    /** panjang */
    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('panjang_display');
        const hiddenInput = document.getElementById('panjang');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        displayInput.addEventListener('input', function() {
            const raw = displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            displayInput.value = formatRupiah(raw);
            hiddenInput.value = raw;
        });
    });

    /** lebar */
    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('lebar_display');
        const hiddenInput = document.getElementById('lebar');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        displayInput.addEventListener('input', function() {
            const raw = displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            displayInput.value = formatRupiah(raw);
            hiddenInput.value = raw;
        });
    });

    /** tinggi */
    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('tinggi_display');
        const hiddenInput = document.getElementById('tinggi');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        displayInput.addEventListener('input', function() {
            const raw = displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            displayInput.value = formatRupiah(raw);
            hiddenInput.value = raw;
        });
    });

    /** fungsi untuk menghitung besaran volume berdasarkan input user */
    document.addEventListener('DOMContentLoaded', function() {
        const panjangInput = document.getElementById('panjang_display');
        const lebarInput = document.getElementById('lebar_display');
        const tinggiInput = document.getElementById('tinggi_display');

        const panjangHidden = document.getElementById('panjang');
        const lebarHidden = document.getElementById('lebar');
        const tinggiHidden = document.getElementById('tinggi');

        const volumeInput = document.getElementById('volume');

        function getRawValue(val) {
            return parseInt(val.replace(/[^0-9]/g, '')) || 0;
        }

        function hitungVolume() {
            const p = getRawValue(panjangInput.value);
            const l = getRawValue(lebarInput.value);
            const t = getRawValue(tinggiInput.value);
            const volume = p * l * t;

            if (p > 0 && l > 0 && t > 0) {
                volumeInput.value = volume;
            } else {
                volumeInput.value = '';
            }
        }

        [panjangInput, lebarInput, tinggiInput].forEach(input => {
            input.addEventListener('input', hitungVolume);
        });
    });

    /** telepon */
    document.addEventListener('DOMContentLoaded', function() {
        const telpInput = document.getElementById('receiver_telp');

        telpInput.addEventListener('input', function() {
            // Ambil hanya digit
            let raw = telpInput.value.replace(/\D/g, '');

            // Paksa mulai dengan "62"
            if (!raw.startsWith('62')) {
                raw = '62' + raw.replace(/^0+/, '').replace(/^62+/, '');
            }

            // Batasi panjang maksimal (misalnya 15 digit total)
            if (raw.length > 15) {
                raw = raw.substring(0, 15);
            }

            telpInput.value = raw;
        });
    });

    // Inisialisasi Select2 untuk kota_tujuan
    // Pastikan Anda sudah mengimpor jQuery dan Select2 di halaman ini
    $(document).ready(function() {
        $('#kota_tujuan').select2({
            placeholder: '-- cari kecamatan/kelurahan --',
            minimumInputLength: 3,
            ajax: {
                url: '<?= base_url("superadmin/cari_kota_ajax") ?>',
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        search: params.term // kata yang diketik user
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: String(item.zip_code + '-' + item.city_name),
                                text: item.city_name + ' - ' + item.province_name + ' (' + item.zip_code + ')'
                            };
                        })
                    };
                },
                cache: true
            }
        });

        $('#kota_tujuan').on('select2:select', function(e) {
            const selectedData = e.params.data;

            // Tambahkan secara eksplisit ke DOM agar form bisa submit value-nya
            $(this).append(
                $('<option>', {
                    value: selectedData.id,
                    text: selectedData.text,
                    selected: true
                })
            );
        });

        $('form').on('submit', function(e) {
            console.log('Kota Tujuan:', $('#kota_tujuan').val());
        });

        $('.pilihan').select2();
    });
</script>