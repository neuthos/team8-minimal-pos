<!-- view_penjualan.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Penjualan</title>
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

    <h1>Daftar Penjualan</h1>

    <?php
    // Include database connection
    require_once('db_config.php');

    // Include the Penjualan class
    require_once('./controllers/Penjualan.php');

    // Create Penjualan object with the database connection
    $penjualanObj = new Penjualan($conn);

    // Check if form submitted for adding new Penjualan
    if (isset($_POST['submit'])) {
        $jumlahPenjualan = $_POST['jumlah_penjualan'];
        $idPengguna = $_POST['id_pengguna'];
        $idPelanggan = $_POST['id_pelanggan'];
        $idBarang = $_POST['id_barang'];

        $penjualanObj->createPenjualan($jumlahPenjualan, $idPengguna, $idPelanggan, $idBarang);
    }

    if (isset($_POST['update'])) {
        $idPenjualan = $_POST['id_penjualan'];
        $jumlahPenjualan = $_POST['jumlah_penjualan'];
        $idPengguna = $_POST['id_pengguna'];
        $idPelanggan = $_POST['id_pelanggan'];
        $idBarang = $_POST['id_barang'];

        $penjualanObj->updatePenjualan($idPenjualan, $jumlahPenjualan, $idPengguna, $idPelanggan, $idBarang);
    }

    if (isset($_GET['delete'])) {
        $idPenjualan = $_GET['delete'];

        $penjualanObj->deletePenjualan($idPenjualan);
    }

    $penjualanList = $penjualanObj->getAllPenjualan();
    ?>
    <table>
        <tr>
            <th>ID Penjualan</th>
            <th>ID Barang</th>
            <th>Jumlah Penjualan</th>
            <th>ID Pengguna</th>
            <th>ID Pelanggan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($penjualanList as $penjualan): ?>
        <tr>
            <td><?php echo $penjualan['IdPenjualan']; ?></td>
            <td><?php echo $penjualan['IdBarang']; ?></td>
            <td><?php echo $penjualan['JumlahPenjualan']; ?></td>
            <td><?php echo $penjualan['IdPengguna']; ?></td>
            <td><?php echo $penjualan['IdPelanggan']; ?></td>
            <td>
                <a href="?delete=<?php echo $penjualan['IdPenjualan']; ?>">Delete</a>
                <button onclick="editPenjualan(<?php echo $penjualan['IdPenjualan']; ?>, <?php echo $penjualan['JumlahPenjualan']; ?>, <?php echo $penjualan['IdPengguna']; ?>, <?php echo $penjualan['IdPelanggan']; ?>)">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form for adding or updating Penjualan -->
    <form id="penjualanForm" method="post">
        <input type="hidden" id="idPenjualan" name="id_penjualan" value="">
        <input type="text" id="idBarang" name="id_barang" placeholder="ID Barang" required>
        <input type="text" id="jumlahPenjualan" name="jumlah_penjualan" placeholder="Jumlah Penjualan" required>
        <input type="text" id="idPengguna" name="id_pengguna" placeholder="ID Pengguna" required>
        <input type="text" id="idPelanggan" name="id_pelanggan" placeholder="ID Pelanggan" required>
        <button type="submit" id="submitBtn" name="submit">Tambah Penjualan</button>
        <button type="submit" id="updateBtn" name="update" style="display: none;">Update Penjualan</button>
    </form>

    <script>
        function editPenjualan(idPenjualan, jumlahPenjualan, hargaJual, idPengguna, idPelanggan) {
            document.getElementById("idPenjualan").value = idPenjualan;
            document.getElementById("jumlahPenjualan").value = jumlahPenjualan;
            document.getElementById("hargaJual").value = hargaJual;
            document.getElementById("idPengguna").value = idPengguna;
            document.getElementById("idPelanggan").value = idPelanggan;
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        }
    </script>
</body>
</html>
