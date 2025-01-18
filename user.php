<h1 class="mt-4">Daftar Pengguna</h1>
<div class="row">
    <div class="col-md-12">
        <a href="?page=user_tambah" class="btn btn-primary">+ Tambah Data</a>
        <br>
        <br>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacin="5">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
            <?php
            $i = 1;
                $query = mysqli_query($koneksi, "SELECT id_user, nama, username, email, alamat, no_telepon, level FROM user");
                while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['no_telepon']; ?></td>
                        <td><?php echo $data['level']; ?></td>
                        <td>
                            <a href="?page=user_ubah&&id=<?php echo $data['id_user']; ?>" class="btn btn-info">Ubah</a>
                            <a onclick="return confirm('Apakah Anda Akan menghapus data ini')" href="?page=user_hapus&&id=<?php echo $data['id_user']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    <tr>
                        <?php
                }
            ?>
        </table>
    </div>
</div>