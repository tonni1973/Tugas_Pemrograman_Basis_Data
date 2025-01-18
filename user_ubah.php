<h1 class="mt-4">Tambah User</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                 $id = $_GET['id'];
                if (isset($_POST['submit'])) {
                    $nama = $_POST['nama_lengkap'];
                    $email = $_POST['email'];
                    $no_telepon = $_POST['no_telepon'];
                    $alamat = $_POST['alamat'];
                    $username = $_POST['username'];
                    $level = $_POST['level'];

                    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email', no_telepon='$no_telepon', alamat='$alamat', username='$username', level='$level' where id_user='$id'");

                    if ($update) {
                        echo '<script>alert("Data Berhasil Diubah. Silahkan Login"); location.href="?page=user"</script>';
                    } else {
                        echo '<script>alert("Data Gagal Diubah")</script>';
                    }
                }
                $query = mysqli_query($koneksi, "SELECT * FROM user where id_user=$id");
                $data = mysqli_fetch_array($query);
                ?>
                <form method="post">
                    <div class="row mb-3">
                        <div class="col-md-4">Nama Lengkap</div>
                        <div class="col-md-8">
                            <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama']?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8">
                            <input type="text" name="email" class="form-control" value="<?php echo $data['email']?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">No Telepon</div>
                        <div class="col-md-8">
                            <input type="number" name="no_telepon" class="form-control" value="<?php echo $data['no_telepon']?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Alamat</div>
                        <div class="col-md-8">
                            <input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Username</div>
                        <div class="col-md-8">
                            <input type="text" name="username" rows="5" class="form-control" value="<?php echo $data['username']?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Password</div>
                        <div class="col-md-8">
                            <input type="password" name="password" rows="5" class="form-control" value="<?php echo $data['password']?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Level</div>
                        <div class="col-md-8">
                            <select name="level" id="level" class="form-control" required>
                                <option value="admin" <?php echo ($data['level'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="peminjam" <?php echo ($data['level'] === 'peminjam') ? 'selected' : ''; ?>>Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="cold-md-8">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page-kategori" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>