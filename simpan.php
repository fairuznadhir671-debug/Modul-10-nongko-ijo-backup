<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_masalah = $_POST['jenis_masalah'];
    $keterangan    = $_POST['keterangan'];
    $waktu_kejadian = $_POST['waktu_kejadian'];
    $latitude      = $_POST['latitude'];
    $longitude     = $_POST['longitude'];

    // 1. Proses Upload File Foto Bukti
    $nama_foto = $_FILES['foto']['name'];
    $tmp_name  = $_FILES['foto']['tmp_name'];
    $folder    = 'uploads/';

    // Membuat nama file unik berdasarkan timestamp agar tidak bentrok
    $nama_foto_baru = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $nama_foto);
    $target_file    = $folder . $nama_foto_baru;

    if (move_uploaded_file($tmp_name, $target_file)) {

        // 2. Simpan Data ke Database MySQL
        $query = "INSERT INTO laporan (jenis_masalah, keterangan, waktu_kejadian,  latitude, longitude, foto) 
                  VALUES ('$jenis_masalah', '$keterangan', '$waktu_kejadian', '$latitude', '$longitude', '$nama_foto_baru')";

        if (mysqli_query($conn, $query)) {

            // 3. Konfigurasi Pengiriman Telegram API (sendPhoto)
            $telegram_token = '8729720029:AAG0D4pka2SInGWZUIneF4cKQj4_iglLMZA'; 
            $chat_id        = '5592669481'; 

            // Text Pesan Caption
            $caption  = "🚨 <b>LAPORAN PATROLI NONGKOIJO ECOGUARD</b> 🚨\n\n";
            $caption .= "📌 <b>Jenis Masalah:</b> " . htmlspecialchars($jenis_masalah) . "\n";
            $caption .= "📝 <b>Keterangan:</b> " . htmlspecialchars($keterangan) . "\n";
            $caption .= "⏰ <b>Waktu Kejadian:</b> " . htmlspecialchars($waktu_kejadian) . "\n";
            $caption .= "📍 <b>Koordinat:</b> " . $latitude . ", " . $longitude . "\n\n";
            $caption .= "🗺️ <a href='https://maps.google.com/?q=" . $latitude . "," . $longitude . "'>Lihat di Google Maps</a>";

            // Endpoint cURL sendPhoto
            $url = "https://api.telegram.org/bot" . $telegram_token . "/sendPhoto";

            $post_fields = [
                'chat_id'    => $chat_id,
                'photo'      => new CURLFile(realpath($target_file)),
                'caption'    => $caption,
                'parse_mode' => 'HTML'
            ];

            // Kirim request via cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            // Verifikasi pengiriman Telegram
            if ($result && isset($result['ok']) && $result['ok'] === true) {
                $msg_id = $result['result']['message_id'];
                echo "<script>
                        alert('BERHASIL! Laporan & Foto Bukti tersimpan (ID Pesan Telegram: " . $msg_id . ")');
                        window.location.href='index.php';
                      </script>";
            } else {
                $error_msg = isset($result['description']) ? $result['description'] : 'Gagal mengirim ke Telegram';
                echo "<script>
                        alert('Data tersimpan di Database, TETAPI Gagal Kirim Telegram: " . addslashes($error_msg) . "');
                        window.location.href='index.php';
                      </script>";
            }

        } else {
            echo "Gagal menyimpan ke Database: " . mysqli_error($conn);
        }

    } else {
        echo "Gagal mengunggah foto ke folder uploads. Pastikan folder uploads sudah dibuat!";
    }
}
?>