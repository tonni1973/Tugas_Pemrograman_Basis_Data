<h1 class="mt-4">Ulasan Buku</h1>
<div class="row">
    <div class="col-md-12">
        <a href="?page=ulasan_tambah" class="btn btn-primary">+ Tambah Data</a>
        <br>
        <br>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacin="5">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Ulasan</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
            <?php
            $i = 1;
                if ($_SESSION['user']['level'] != 'admin'){
                    $nameUser = $_SESSION['user']['nama'];
                    $query = mysqli_query($koneksi, "SELECT * FROM ulasan LEFT JOIN user on user.id_user = ulasan.id_user LEFT JOIN buku on buku.id_buku = ulasan.id_buku where user.nama = '$nameUser'");
                } else {
                    $query = mysqli_query($koneksi, "SELECT * FROM ulasan LEFT JOIN user on user.id_user = ulasan.id_user LEFT JOIN buku on buku.id_buku = ulasan.id_buku");
                }

                while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['ulasan']; ?></td>
                        <td><?php echo $data['rating']; ?></td>
                        <td>
                            <?php
                                if ($data['nama'] == $_SESSION['user']['nama']){
                            ?>
                                <a href="?page=ulasan_ubah&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-info">Ubah</a>
                                <a onclick="return confirm('Apakah Anda Akan menghapus data ini')" href="?page=ulasan_hapus&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-danger">Hapus</a>
                            <?php
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