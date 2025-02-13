<?php
require 'vendor/autoload.php'; // Pastikan lokasi autoload sesuai dengan instalasi

use Dompdf\Dompdf;
use Dompdf\Options;

include "koneksi.php";

// Ambil parameter filter dari URL
$user = isset($_GET['user']) ? $_GET['user'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$tanggal_peminjaman = isset($_GET['tanggal_peminjaman']) ? $_GET['tanggal_peminjaman'] : '';
$tanggal_pengembalian = isset($_GET['tanggal_pengembalian']) ? $_GET['tanggal_pengembalian'] : '';

// Buat kondisi WHERE berdasarkan filter
$where = [];
if (!empty($user)) {
    $where[] = "peminjaman.id_user = '$user'";
}
if (!empty($status)) {
    $where[] = "peminjaman.status_peminjaman = '$status'";
}
if (!empty($tanggal_peminjaman)) {
    $where[] = "peminjaman.tanggal_peminjaman = '$tanggal_peminjaman'";
}
if (!empty($tanggal_pengembalian)) {
    $where[] = "peminjaman.tanggal_pengembalian = '$tanggal_pengembalian'";
}

// Gabungkan kondisi WHERE jika ada filter
$where_clause = !empty($where) ? " WHERE " . implode(" AND ", $where) : "";

// Query data dengan filter
$query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                                 LEFT JOIN user ON user.id_user = peminjaman.id_user 
                                 LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku 
                                 $where_clause");

// Buat tampilan HTML untuk PDF
$html = '<h2 style="text-align:center;">Laporan Peminjaman Buku</h2>';
$html .= '<table border="1" width="100%" cellpadding="8" cellspacing="0">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
            </tr>';
$i = 1;
while ($data = mysqli_fetch_array($query)) {
    $html .= "<tr>
                <td>{$i}</td>
                <td>{$data['nama']}</td>
                <td>{$data['judul']}</td>
                <td>{$data['tanggal_peminjaman']}</td>
                <td>{$data['tanggal_pengembalian']}</td>
                <td>{$data['status_peminjaman']}</td>
              </tr>";
    $i++;
}
$html .= '</table>';

// Konfigurasi Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Hasilkan PDF
$dompdf->stream("Laporan_Peminjaman.pdf", ["Attachment" => false]); // false agar langsung tampil di browser
exit;
?>
