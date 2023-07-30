<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
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

    <h1>Daftar Barang</h1>

    <?php
    require_once('db_config.php');

    require_once('./controllers/Barang.php');

    $barangObj = new Barang($conn);

    if (isset($_POST['submit'])) {
        $namaBarang = $_POST['nama_barang'];
        $keterangan = $_POST['keterangan'];
        $satuan = $_POST['satuan'];
        $idPengguna = $_POST['id_pengguna'];
        $hargaBeli = $_POST['harga_beli'];
        $hargaJual = $_POST['harga_jual'];

        $barangObj->createBarang($namaBarang, $keterangan, $satuan, $idPengguna, $hargaBeli, $hargaJual);
    }

    if (isset($_POST['update'])) {
        $idBarang = $_POST['id_barang'];
        $namaBarang = $_POST['nama_barang'];
        $keterangan = $_POST['keterangan'];
        $satuan = $_POST['satuan'];
        $idPengguna = $_POST['id_pengguna'];
        $hargaBeli = $_POST['harga_beli'];
        $hargaJual = $_POST['harga_jual'];

        $barangObj->updateBarang($idBarang, $namaBarang, $keterangan, $satuan, $idPengguna, $hargaBeli, $hargaJual);
    }

    if (isset($_GET['delete'])) {
        $idBarang = $_GET['delete'];
        $barangObj->deleteBarang($idBarang);
    }

    $barangList = $barangObj->getAllBarang();
    ?>

    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Keterangan</th>
            <th>Satuan</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>ID Pengguna</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($barangList as $barang): ?>
        <tr>
            <td><?php echo $barang['IdBarang']; ?></td>
            <td><?php echo $barang['NamaBarang']; ?></td>
            <td><?php echo $barang['Keterangan']; ?></td>
            <td><?php echo $barang['Satuan']; ?></td>
            <td><?php echo $barang['HargaBeli']; ?></td>
            <td><?php echo $barang['HargaJual']; ?></td>
            <td><?php echo $barang['IdPengguna']; ?></td>
            <td>
                <a href="?delete=<?php echo $barang['IdBarang']; ?>">Delete</a>
                <button onclick="editBarang(<?php echo $barang['IdBarang']; ?>, '<?php echo $barang['NamaBarang']; ?>', '<?php echo $barang['Keterangan']; ?>', '<?php echo $barang['Satuan']; ?>', <?php echo $barang['IdPengguna']; ?>)">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form id="barangForm" method="post">
        <input type="hidden" id="idBarang" name="id_barang" value="">
        <input type="text" id="namaBarang" name="nama_barang" placeholder="Nama Barang" required>
        <textarea id="keterangan" name="keterangan" placeholder="Keterangan" required></textarea>
        <input type="text" id="satuan" name="satuan" placeholder="Satuan" required>
        <input type="text" id="hargaBeli" name="harga_beli" placeholder="Harga Beli" required>
        <input type="text" id="hargaJual" name="harga_jual" placeholder="Harga Jual" required>
        <input type="text" id="idPengguna" name="id_pengguna" placeholder="ID Pengguna" required>
        <button type="submit" id="submitBtn" name="submit">Tambah Barang</button>
        <button type="submit" id="updateBtn" name="update" style="display: none;">Update Barang</button>
    </form>

    <script>
        function editBarang(idBarang, namaBarang, keterangan, satuan, idPengguna) {
            document.getElementById("idBarang").value = idBarang;
            document.getElementById("namaBarang").value = namaBarang;
            document.getElementById("keterangan").value = keterangan;
            document.getElementById("satuan").value = satuan;
            document.getElementById("idPengguna").value = idPengguna;
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        }
    </script>
</body>
</html>
