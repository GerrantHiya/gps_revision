<form action="<?= base_url('superadmin/histori-perjalanan/' . $armada_data['plat_nomor']) ?>" method="get" class="row mb-3 align-items-center">
    <div class="col-sm-1">
        <a href="<?= base_url('superadmin/kelola-armada/detail/') . $armada_data['plat_nomor'] ?>" class="badge badge-secondary">&laquo; back</a>
    </div>
    <div class="col-sm-4">
        <select class="form-control text-center" required name="tgl">
            <option value="">-- Pilih Tanggal --</option>
            <?php foreach ($sort_tgl as $tanggal) { ?>
                <option value="<?= $tanggal['tgl'] ?>"><?= date('d M Y', strtotime($tanggal['tgl'])) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-sm-1">
        <input type="submit" value="Terapkan" class="btn btn-secondary">
    </div>
</form>

Ditampilkan: <?= (!empty($tgl)) ? $tgl : '-no data-' ?>

<div class="mb-4" id="map-div">
    <?php if (count($armada) != 0): ?>
        <div id="map" style="height: 500px;"></div>
    <?php else: ?>
        <div class="alert alert-info">Belum ada data</div>
    <?php endif ?>
</div>

<script>
    // Ambil data dari PHP (sudah dalam format JSON)
    const data = <?php echo $jsonData; ?>;

    // Tentukan posisi awal peta (Bekasi)
    
    // Tentukan posisi awal peta berdasarkan titik terakhir dari data yang dipilih
    let initialLat, initialLon;
    
    if (data.length > 0) {
        // Ambil titik terakhir dari array data
        const lastPoint = data[data.length - 1];
        initialLat = parseFloat(lastPoint.latitude);
        initialLon = parseFloat(lastPoint.longitude);
    } else {
        // Fallback ke koordinat armada jika data kosong
        initialLat = <?= $armada_data['latitude'] ?>;
        initialLon = <?= $armada_data['longitude'] ?>;
    }

    const map = L.map('map').setView([initialLat, initialLon], 15);

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Icon hijau untuk titik awal
    const greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
        shadowUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Icon merah untuk titik akhir
    const redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Buat array untuk menyimpan koordinat rute
    const routeCoordinates = [];

    // Loop setiap titik dari array PHP
    data.forEach((item, index) => {
        const lat = parseFloat(item.latitude);
        const lon = parseFloat(item.longitude);

        // Tambahkan koordinat ke array untuk rute
        routeCoordinates.push([lat, lon]);

        // ubah format tanggal ke "M d, Y"
        const date = new Date(item.created_at);
        const formattedDate = date.toLocaleDateString('en-US', {
            month: 'short',
            day: '2-digit',
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric'
        });

        const popupContent = `
        <b>${item.keterangan}</b><br>
        Plat: ${item.plat_nomor}<br>
        Waktu: ${formattedDate}<br>
        Koordinat: ${lat}, ${lon}`;

        // Tambahkan marker hanya di awal dan akhir rute
        const icon = index === 0 ? greenIcon : (index === data.length - 1 ? redIcon : null);
        
        if (icon) {
            L.marker([lat, lon], { icon: icon })
                .addTo(map)
                .bindPopup(popupContent);
        }
    });

    // Gambar polyline (garis rute)
    L.polyline(routeCoordinates, {
        color: 'blue',
        weight: 3,
        opacity: 0.7,
        // dashArray: '5, 5' // opsional: garis putus-putus
    }).addTo(map);
</script>