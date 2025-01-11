<h1 class="mt-4">Buku</h1>
<div class="row">
    <div class="col-md-12">
        <?php
            if($_SESSION["user"]["level"] == "admin"){
        ?>
        <a href="?page=buku_tambah" class="btn btn-primary">+ Tambah Data</a>
        <br>
        <br>
        <?php
            }
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacin="5">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Deskripsi</th>
                <?php
                    if($_SESSION["user"]["level"] == "admin"){
                ?>
                <th>Aksi</th>
                <?php
                    }
                ?>
            </tr>
            <?php
            $i = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori on buku.id_kategori = kategori.id_kategori");
                while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo $data['kategori']; ?></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['penulis']; ?></td>
                        <td><?php echo $data['penerbit']; ?></td>
                        <td><?php echo $data['tahun_terbit']; ?></td>
                        <td><?php echo $data['deskripsi']; ?></td>
                        <?php
                            if($_SESSION["user"]["level"] == "admin"){
                        ?>
                        <td>
                            <a href="?page=buku_ubah&&id=<?php echo $data['id_buku']; ?>" class="btn btn-info">Ubah</a>
                            <a onclick="return confirm('Apakah Anda Akan menghapus data ini')" href="?page=buku_hapus&&id=<?php echo $data['id_buku']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                        <?php
                            }
                        ?>
                    <tr>
                        <?php
                }
            ?>
        </table>
    </div>
</div>