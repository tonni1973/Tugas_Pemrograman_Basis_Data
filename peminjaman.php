<h1 class="mt-4">Pinjam Buku</h1>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="?page=peminjaman_tambah" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Peminjaman</a>
            <?php 
                if($_SESSION['user']['level'] == 'admin'){
            ?>
            <form method="GET" action="" class="d-flex align-items-center">
                <input type="hidden" name="page" value="peminjaman">
                <input type="text" name="cari" class="form-control form-control-sm" placeholder="Cari Nama" style="width: 200px;">
                <button type="submit" class="btn btn-primary btn-sm ms-2">Cari</button>
            </form>
            <?php
                } 
            ?>
        </div>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacin="5">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
                <?php
                    if($_SESSION['user']['level'] == 'admin'){
                ?>
                <th>Aksi</th>
                <?php
                    } 
                ?>
            </tr>
            <?php
                $i = 1;

                if($_SESSION['user']['level'] != 'admin'){
                    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku WHERE peminjaman.id_user=" . $_SESSION['user']['id_user']);
                } else {                    
                    $cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';
    
                    $sql = "SELECT * FROM peminjaman LEFT JOIN user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku";
                    if (!empty($cari)) {
                        $sql .= " WHERE user.nama LIKE '%$cari%'";
                    }

                    $query = mysqli_query($koneksi, $sql);
                }

                while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['tanggal_peminjaman']; ?></td>
                        <td><?php echo $data['tanggal_pengembalian']; ?></td>
                        <td><?php echo $data['status_peminjaman']; ?></td>
                        <td>
                            <?php
                                if($data['status_peminjaman'] != 'dikembalikan'){
                                    if($_SESSION['user']['level'] == 'admin'){
                            ?>
                                <a href="?page=peminjaman_ubah&&id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info">Ubah</a>
                                <a onclick="return confirm('Apakah Anda Akan menghapus data ini')" href="?page=peminjaman_hapus&&id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-danger">Hapus</a>
                            <?php 
                                    }
                                }
                            ?>
                        </td>
                    <tr>
                        <?php
                }
            ?>
        </table>
    </div>
</div>