<?php
    if($_SESSION["user"]["level"] != "admin"){
        header('location:404.php');
    }
?>
<h1 class="mt-4">Laporan Peminjaman Buku</h1>
<div class="row">
    <div class="col-md-12">
        <form method="GET" action="">
            <input type="hidden" name="page" value="laporan">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="user">User</label>
                    <select name="user" id="user" class="form-control">
                        <option value="">Semua User</option>
                        <?php
                        $query_user = mysqli_query($koneksi, "SELECT * FROM user");
                        while($user = mysqli_fetch_array($query_user)){
                            $selected = ($_GET['user'] == $user['id_user']) ? 'selected' : '';
                            echo "<option value='".$user['id_user']."' $selected>".$user['nama']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="status">Status Peminjaman</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="Dipinjam" <?php if($_GET['status'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
                        <option value="Dikembalikan" <?php if($_GET['status'] == 'dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" value="<?php echo $_GET['tanggal_peminjaman'] ?? ''; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" value="<?php echo $_GET['tanggal_pengembalian'] ?? ''; ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="?page=laporan" class="btn btn-secondary">Reset</a>
        </form>
        <br>
        
        <?php 
            if(isset($_GET['user']) ||  isset($_GET['status']) || isset($_GET['tanggal_peminjaman']) || isset($_GET['tanggal_pengembalian'])){
        ?>
        <a href="cetak.php?user=<?php echo $_GET['user'] ?>&status=<?php echo $_GET['status'] ?>&tanggal_peminjaman=<?php echo $_GET['tanggal_peminjaman'] ?>&tanggal_pengembalian=<?php echo $_GET['tanggal_pengembalian'] ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i>Cetak Data</a>
        <a href="cetak_excel.php?user=<?php echo $_GET['user'] ?>&status=<?php echo $_GET['status'] ?>&tanggal_peminjaman=<?php echo $_GET['tanggal_peminjaman'] ?>&tanggal_pengembalian=<?php echo $_GET['tanggal_pengembalian'] ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Export To Excel</a>
        <?php } else {  ?>
        <a href="cetak.php" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i>Cetak Data</a>
        <a href="cetak_excel.php" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Export To Excel</a>
        <?php } ?>
        <br>
        <br>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
            </tr>
            <?php
            $i = 1;
            $where = [];
            if(!empty($_GET['user'])){
                $where[] = "peminjaman.id_user = '".$_GET['user']."'";
            }
            if(!empty($_GET['status'])){
                $where[] = "peminjaman.status_peminjaman = '".$_GET['status']."'";
            }
            if(!empty($_GET['tanggal_peminjaman'])){
                $where[] = "peminjaman.tanggal_peminjaman = '".$_GET['tanggal_peminjaman']."'";
            }
            if(!empty($_GET['tanggal_pengembalian'])){
                $where[] = "peminjaman.tanggal_pengembalian = '".$_GET['tanggal_pengembalian']."'";
            }
            $where_clause = !empty($where) ? " WHERE " . implode(" AND ", $where) : "";
            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku $where_clause");
            while($data = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $i++?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['judul']; ?></td>
                    <td><?php echo $data['tanggal_peminjaman']; ?></td>
                    <td><?php echo $data['tanggal_pengembalian']; ?></td>
                    <td><?php echo $data['status_peminjaman']; ?></td>
                <tr>
                    <?php
            }
            ?>
        </table>
    </div>
</div>
