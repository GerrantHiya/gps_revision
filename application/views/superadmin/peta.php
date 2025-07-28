<div class="mb-4" id="map-div">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('superadmin/kelola-armada') ?>" class="badge badge-secondary mb-3">&laquo; kembali</a>
            <a href="<?= base_url('superadmin/kelola-armada/detail/') . $armada['plat_nomor'] ?>" class="badge badge-info">refresh</a>
        </div>
        <div class="col"></div>
        <div class="col">
            <label for="" class="form-label"><strong>Nama Sopir :</strong></label>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <input type="text" value="<?= $armada['nama_jenis'] ?>" disabled class="form-control text-center">
        </div>
        <div class="col">
            <input type="text" value="<?= $armada['plat_nomor'] ?>" disabled class="form-control text-center">
        </div>
        <div class="col">
            <input type="text" value="<?= $armada['NamaLengkap'] ?>" disabled class="form-control text-center">
        </div>
    </div>


    <?php if (!empty($armada['latitude']) && !empty($armada['longitude'])) { ?>
        <div id="map"></div>
    <?php } else { ?>
        <div class="alert alert-info text-center">Belum ada data</div>
    <?php } ?>
</div>

<script>
    var latitude = <?= $armada['latitude'] ?? 0 ?>;
    var longitude = <?= $armada['longitude'] ?? 0 ?>;
    var zoom = 15;
    var map = L.map('map').setView([latitude, longitude], zoom);

    // Gunakan tile dari OpenStreetMap (GRATIS)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        // attribution: '© OpenStreetMap contributors'
        attribution: '© Gerrant Hiya',
    }).addTo(map);

    // Contoh marker armada
    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Plat: <?= $armada['plat_nomor'] ?>')
        .openPopup();
</script>