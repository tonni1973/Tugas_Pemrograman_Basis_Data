<?php
include_once "koneksi.php";
require 'vendor/autoload.php'; // Pastikan ini sesuai dengan lokasi autoload

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header tabel
$headers = ['No', 'User', 'Buku', 'Tanggal Peminjaman', 'Tanggal Pengembalian', 'Status Peminjaman'];
$column = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($column . '1', $header);
    $column++;
}

// Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku");
$rowNumber = 2; // Baris mulai setelah header
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

// Set header untuk unduhan Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_peminjaman.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
