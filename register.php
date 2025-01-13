<?php 
    include "koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registrasi Ke Perpustakaan Digital</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register Perpustakaan Digital</h3></div>
                                    <div class="card-body">
                                        <?php 
                                            if(isset($_POST['register'])){
                                                $nama = $_POST['nama'];
                                                $email = $_POST['email'];
                                                $no_telepon = $_POST['no_telepon'];
                                                $alamat = $_POST['alamat'];
                                                $username = $_POST['username'];                                                
                                                $password = md5($_POST['password']);
                                                $level = $_POST['level'];

                                                $insert = mysqli_query($koneksi, "INSERT INTO user(nama, email, alamat, no_telepon, username, password, level) VALUES('$nama', '$email', '$alamat', '$no_telepon', '$username', '$password', '$level')");
                                                
                                                if ($insert){
                                                    echo '<script>alert("Registrasi Berhasil. Silahkan Login"); location.href="login.php"</script>';
                                                } else {
                                                    echo '<script>alert("Registrasi Gagal. Silahkan Ulang Kembali")</script>';
                                                }
                                            }
                                        ?>
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama Lengkap" required />
                                                <label for="inputEmail">Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" name="email" placeholder="Masukan Alamata Email" required />
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" name="no_telepon" placeholder="Masukan no telepon" required />
                                                <label for="inputPassword">No. Telepon</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea name="alamat" class="form-control py-4" rows="5"></textarea>
                                                <label for="inputPassword">Alamat</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" name="username" placeholder="Masukkan username" required />
                                                <label for="inputPassword">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" required />
                                                <label for="inputPassword">Password</label>
                                            </div>
                            
                                            <div class="form-floating mb-3">
                                                <select name="level" id="level" class="form-control" required>
                                                    <option value="admin">Admin</option>
                                                    <option value="peminjam">Member</option>
                                                </select>
                                                <label for="level">Level</label>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" href="index.html" type="submit" name="register" value="register">Register</button>
                                                <a class="btn btn-danger" href="login.php">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                            &copy; 2024 Perpustakaan Digital  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
