<?php
include_once "koneksi.php";
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Perpustakaan</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <?php
                        if ($_SESSION["user"]["level"] != "peminjam") {
                        ?>
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="?">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                        <?php
                        }
                        ?>
                        <div class="sb-sidenav-menu-heading">Navigasi</div>
                        <?php
                        if ($_SESSION["user"]["level"] != "peminjam") {
                        ?>
                            <a class="nav-link" href="?page=kategori">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Kategori
                            </a>
                        <?php
                        }
                        ?>
                        <a class="nav-link" href="?page=buku">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Buku
                        </a>
                        <?php
                        if ($_SESSION["user"]["level"] == "admin") {
                        ?>
                            <a class="nav-link" href="?page=user">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Pengguna
                            </a>
                        <?php
                        }
                        ?>
                        <a class="nav-link" href="?page=peminjaman">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Peminjaman
                        </a>
                        <a class="nav-link" href="?page=ulasan">
                            <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                            Ulasan
                        </a>
                        <?php
                        if ($_SESSION["user"]["level"] != "peminjam") {
                        ?>
                            <a class="nav-link" href="?page=laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Laporan Peminjaman
                            </a>
                        <?php
                        }
                        ?>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php
                    echo $_SESSION['user']['nama'];
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                    if (file_exists($page . ".php")) {
                        include $page . ".php";
                    } else {
                        include "404.php";
                    }
                    ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Perpustakaan Digital</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        var ctxKategori = document.getElementById('chartKategori').getContext('2d');
        var ctxUser = document.getElementById('chartUser').getContext('2d');

        // Ambil data dari server PHP
        <?php
        $totalKategori = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori"));
        $totalBuku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
        $totalUlasan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ulasan"));
        $totalUser = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user"));
        $kategori = mysqli_query($koneksi, "SELECT kategori FROM kategori");
        $totalBukuKategori = mysqli_query($koneksi, "SELECT COUNT(b.id_buku) AS jumlah_buku FROM kategori k LEFT JOIN buku b ON k.id_kategori = b.id_kategori GROUP BY k.id_kategori, k.kategori;");

        $ratingBuku = mysqli_query($koneksi, "SELECT buku.judul as judul, ROUND(AVG(ulasan.rating) / COUNT(ulasan.rating), 1) AS rating FROM buku LEFT JOIN ulasan ON buku.id_buku = ulasan.id_buku GROUP BY buku.id_buku ORDER BY rating desc LIMIT 5;");

        $kategoriLabels = [];
        while ($row = mysqli_fetch_assoc($kategori)) {
            $kategoriLabels[] = '"' . $row['kategori'] . '"';
        }

        $kategoriLabelsString = implode(',', $kategoriLabels);

        $backgroundColors = [];
        $warnaArray = ['#007bff', '#ffc107', '#28a745', '#dc3545', '#6f42c1', '#20c997', '#17a2b8', '#e83e8c', '#fd7e14', '#343a40'];
        for ($i = 0; $i < count($kategoriLabels); $i++) {
            $backgroundColors[] = '"' . $warnaArray[$i % count($warnaArray)] . '"';
        }
        $backgroundColorsString = implode(',', $backgroundColors);

        $totalBukuKategoriLabels = [];
        while ($row = mysqli_fetch_assoc($totalBukuKategori)) {
            $totalBukuKategoriLabels[] = '"' . $row['jumlah_buku'] . '"';
        }
        $totalBukuKategoriLabelsString = implode(',', $totalBukuKategoriLabels);

        // rating buku
        $judulBukuLabels = [];
        $ratingBukuLabels = [];
        while ($row = mysqli_fetch_assoc($ratingBuku)) {
            $judulBukuLabels[] = '"' . $row['judul'] . '"';
            $ratingBukuLabels[] = '"' . $row['rating'] . '"';
        }

        $judulBukuLabelsString = implode(',', $judulBukuLabels);
        $ratingBukuLabelsString = implode(',', $ratingBukuLabels);
        ?>

        // Grafik Kategori dan Buku
        var chartKategori = new Chart(ctxKategori, {
            type: 'pie',
            data: {
                labels: [<?php echo $kategoriLabelsString; ?>],
                datasets: [{
                    data: [<?php echo $totalBukuKategoriLabelsString; ?>],
                    backgroundColor: [<?php echo $backgroundColorsString; ?>],
                }]
            }
        });

        // Grafik Ulasan dan User
        var chartUser = new Chart(ctxUser, {
            type: 'horizontalBar',
            data: {
                labels: [<?php echo $judulBukuLabelsString; ?>],
                datasets: [{
                    label: 'Rating',
                    data: [<?php echo $ratingBukuLabelsString; ?>],
                    backgroundColor: [<?php echo $backgroundColorsString; ?>],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>