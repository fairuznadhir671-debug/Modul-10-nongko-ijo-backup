<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NongkoIjo EcoGuard - Laporan Patroli</title>
   
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1448375240586-882707db888b?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        #map {
            height: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            background: #ffffff;
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
        }

        .btn-success-custom {
            background-color: #2e7d32;
            border: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-success-custom:hover {
            background-color: #1b5e20;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="fw-bold">🌲🌲SIPATROLI HUTAN</title>🌲🌲</h1>
        <p class="lead">Sistem Pelaporan Patroli Hutan Secara Real-Time </p>
    </div>

    <div class="row g-4">
        <!-- Kolom Peta -->
        <div class="col-lg-7">
            <div class="glass-card">
                <h4 class="mb-3">📍 Pilih Lokasi Kejadian </h4>
                <div id="map"></div>
            </div>
        </div>

        <!-- Kolom Form Laporan -->
        <div class="col-lg-5">
            <div class="glass-card">
                <h4 class="mb-3">📝 Form Input Laporan Patroli Hutan</h4>
                
                <form action="simpan.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Jenis Masalah</label>
                        <select name="jenis_masalah" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis Masalah --</option>
                            <option value="Penebangan Liar (Illegal Logging)">Penebangan Liar (Illegal Logging)</option>
                            <option value="Kebakaran Hutan">Kebakaran Hutan</option>
                            <option value="Perburuan Satwa Liar">Perburuan Satwa Liar</option>
                            <option value="Pencemaran / Sampah">Pencemaran / Sampah</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan Laporan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Jelaskan kondisi detail di lapangan..." required></textarea>
                    </div>

                    <div class="mb-3">
                     <label class="form-label">Waktu Kejadian</label>
                        <input type="datetime-local" name="waktu_kejadian" id="waktu_kejadian" class="form-control" required>
                    </div>

                    <script>
                     // Otomatis set nilai input ke waktu sekarang
                        const now = new Date();
                        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
                        document.getElementById('waktu_kejadian').value = now.toISOString().slice(0, 16);
                    </script>

                    <div class="mb-3">
                        <label class="form-label">📸 Upload Foto Bukti Kejadian</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" readonly required placeholder="Klik di peta">
                        </div>
                        <div class="col">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" readonly required placeholder="Klik di peta">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success-custom w-100">Kirim Laporan & Notifikasi Real Time</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Inisialisasi Peta (Default koordinat Hutan Nongko Ijo / Kare Madiun)
    var map = L.map('map').setView([-7.6833, 111.6500], 13);

    // Tile Layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // Event Klik Peta
    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup("<b>Lokasi Dipilih</b><br>Lat: " + lat + "<br>Lng: " + lng).openPopup();
    });
</script>
</body>
</html>