<h1 class="mt-4">Tambah User</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_POST['submit'])) {
                    $nama = $_POST['nama_lengkap'];
                    $email = $_POST['email'];
                    $no_telepon = $_POST['no_telepon'];
                    $alamat = $_POST['alamat'];
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $level = $_POST['level'];

                    $insert = mysqli_query($koneksi, "INSERT INTO user(nama, email, alamat, no_telepon, username, password, level) VALUES('$nama', '$email', '$alamat', '$no_telepon', '$username', '$password', '$level')");

                    if ($insert) {
                        echo '<script>alert("Tambah Data Berhasil. Silahkan Login"); location.href="?page=user"</script>';
                    } else {
                        echo '<script>alert("Registrasi Gagal. Silahkan Ulang Kembali")</script>';
                    }
                }
                ?>
                <form method="post">
                    <div class="row mb-3">
                        <div class="col-md-4">Nama Lengkap</div>
                        <div class="col-md-8">
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8">
                            <input type="text" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">No Telepon</div>
                        <div class="col-md-8">
                            <input type="number" name="no_telepon" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Alamat</div>
                        <div class="col-md-8">
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Username</div>
                        <div class="col-md-8">
                            <input type="text" name="username" rows="5" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Password</div>
                        <div class="col-md-8">
                            <input type="password" name="password" rows="5" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Level</div>
                        <div class="col-md-8">
                            <select name="level" id="level" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="peminjam">Member</option>
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