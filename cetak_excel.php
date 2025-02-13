<?php
include_once "koneksi.php";
require 'vendor/autoload.php'; // Pastikan ini sesuai dengan lokasi autoload

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$headers = ['No', 'User', 'Buku', 'Tanggal Peminjaman', 'Tanggal Pengembalian', 'Status Peminjaman'];
$column = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($column . '1', $header);
    $column++;
}

$where = [];
if (!empty($_GET['user'])) {
    $where[] = "peminjaman.id_user = '" . $_GET['user'] . "'";
}
if (!empty($_GET['status'])) {
    $where[] = "peminjaman.status_peminjaman = '" . $_GET['status'] . "'";
}
if (!empty($_GET['tanggal_peminjaman'])) {
    $where[] = "peminjaman.tanggal_peminjaman = '" . $_GET['tanggal_peminjaman'] . "'";
}
if (!empty($_GET['tanggal_pengembalian'])) {
    $where[] = "peminjaman.tanggal_pengembalian = '" . $_GET['tanggal_pengembalian'] . "'";
}


$where_clause = !empty($where) ? " WHERE " . implode(" AND ", $where) : "";


$query = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user ON user.id_user = peminjaman.id_user LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku $where_clause");

$rowNumber = 2; 
$no = 1;

while ($data = mysqli_fetch_array($query)) {
    $sheet->setCellValue('A' . $rowNumber, $no++);
    $sheet->setCellValue('B' . $rowNumber, $data['nama']);
    $sheet->setCellValue('C' . $rowNumber, $data['judul']);
    $sheet->setCellValue('D' . $rowNumber, $data['tanggal_peminjaman']);
    $sheet->setCellValue('E' . $rowNumber, $data['tanggal_pengembalian']);
    $sheet->setCellValue('F' . $rowNumber, $data['status_peminjaman']);
    $rowNumber++;
}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_peminjaman.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
