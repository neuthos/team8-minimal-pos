<!-- view_pengguna.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            width: 300px;
        }
        input[type="text"], textarea {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 14px;
        }
        button {
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="hak_akses.php">Hak Akses</a>
        <a href="pengguna.php">Pengguna</a>
        <a href="barang.php">Barang</a>
        <a href="supplier.php">Supplier</a>
        <a href="pelanggan.php">Pelanggan</a>
        <a href="pembelian.php">Pembelian</a>
        <a href="penjualan.php">Penjualan</a>
    </div>

    <h1>Daftar Pengguna</h1>

    <?php
    require_once('db_config.php');
    require_once('./controllers/Pengguna.php');

    $penggunaObj = new Pengguna($conn);

    // Check if form submitted for adding new Pengguna
    if (isset($_POST['submit'])) {
        $namaPengguna = $_POST['nama_pengguna'];
        $password = $_POST['password'];
        $namaDepan = $_POST['nama_depan'];
        $namaBelakang = $_POST['nama_belakang'];
        $noHp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $idAkses = $_POST['id_akses'];

        $penggunaObj->createPengguna($namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat, $idAkses);
    }

    if (isset($_POST['update'])) {
        $idPengguna = $_POST['id_pengguna'];
        $namaPengguna = $_POST['nama_pengguna'];
        $password = $_POST['password'];
        $namaDepan = $_POST['nama_depan'];
        $namaBelakang = $_POST['nama_belakang'];
        $noHp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $idAkses = $_POST['id_akses'];

        $penggunaObj->updatePengguna($idPengguna, $namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat, $idAkses);
    }

    if (isset($_GET['delete'])) {
        $idPengguna = $_GET['delete'];

        $penggunaObj->deletePengguna($idPengguna);
    }

    $penggunaList = $penggunaObj->getAllPengguna();
    ?>

    <table>
        <tr>
            <th>ID Pengguna</th>
            <th>Nama Pengguna</th>
            <th>Password</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>ID Akses</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($penggunaList as $pengguna): ?>
        <tr>
            <td><?php echo $pengguna['IdPengguna']; ?></td>
            <td><?php echo $pengguna['NamaPengguna']; ?></td>
            <td><?php echo $pengguna['Password']; ?></td>
            <td><?php echo $pengguna['NamaDepan']; ?></td>
            <td><?php echo $pengguna['NamaBelakang']; ?></td>
            <td><?php echo $pengguna['NoHp']; ?></td>
            <td><?php echo $pengguna['Alamat']; ?></td>
            <td><?php echo $pengguna['IdAkses']; ?></td>
            <td>
                <a href="?delete=<?php echo $pengguna['IdPengguna']; ?>">Delete</a>
                <button onclick="editPengguna(<?php echo $pengguna['IdPengguna']; ?>, '<?php echo $pengguna['NamaPengguna']; ?>', '<?php echo $pengguna['Password']; ?>', '<?php echo $pengguna['NamaDepan']; ?>', '<?php echo $pengguna['NamaBelakang']; ?>', '<?php echo $pengguna['NoHp']; ?>', '<?php echo $pengguna['Alamat']; ?>', <?php echo $pengguna['IdAkses']; ?>)">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form id="penggunaForm" method="post">
        <input type="hidden" id="idPengguna" name="id_pengguna" value="">
        <input type="text" id="namaPengguna" name="nama_pengguna" placeholder="Nama Pengguna" required>
        <input type="text" id="password" name="password" placeholder="Password" required>
        <input type="text" id="namaDepan" name="nama_depan" placeholder="Nama Depan" required>
        <input type="text" id="namaBelakang" name="nama_belakang" placeholder="Nama Belakang" required>
        <input type="text" id="noHp" name="no_hp" placeholder="No. HP" required>
        <textarea id="alamat" name="alamat" placeholder="Alamat" required></textarea>
        <input type="text" id="idAkses" name="id_akses" placeholder="ID Akses" required>
        <button type="submit" id="submitBtn" name="submit">Tambah Pengguna</button>
        <button type="submit" id="updateBtn" name="update" style="display: none;">Update Pengguna</button>
    </form>

    <script>
        function editPengguna(idPengguna, namaPengguna, password, namaDepan, namaBelakang, noHp, alamat, idAkses) {
            document.getElementById("idPengguna").value = idPengguna;
            document.getElementById("namaPengguna").value = namaPengguna;
            document.getElementById("password").value = password;
            document.getElementById("namaDepan").value = namaDepan;
            document.getElementById("namaBelakang").value = namaBelakang;
            document.getElementById("noHp").value = noHp;
            document.getElementById("alamat").value = alamat;
            document.getElementById("idAkses").value = idAkses;
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        }
    </script>
</body>
</html>
