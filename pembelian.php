
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pembelian</title>
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

    <h1>Daftar Pembelian</h1>

    <?php
    // Include database connection
    require_once('db_config.php');

    // Include the Pembelian class
    require_once('./controllers/Pembelian.php');

    // Create Pembelian object with the database connection
    $pembelianObj = new Pembelian($conn);

    // Check if form submitted for adding new Pembelian
    if (isset($_POST['submit'])) {
        $jumlahPembelian = $_POST['jumlah_pembelian'];
        $idPengguna = $_POST['id_pengguna'];
        $idSupplier = $_POST['id_supplier'];
        $idBarang = $_POST['id_barang'];

        // Create new Pembelian
        $pembelianObj->createPembelian($jumlahPembelian, $idPengguna, $idSupplier, $idBarang);
    }

    // Check if form submitted for updating Pembelian
    if (isset($_POST['update'])) {
        $idPembelian = $_POST['id_pembelian'];
        $jumlahPembelian = $_POST['jumlah_pembelian'];
        $idPengguna = $_POST['id_pengguna'];
        $idSupplier = $_POST['id_supplier'];
        $idBarang = $_POST['id_barang'];

        // Update Pembelian
        $pembelianObj->updatePembelian($idPembelian, $jumlahPembelian, $idPengguna, $idSupplier, $idBarang);
    }

    // Check if delete button clicked
    if (isset($_GET['delete'])) {
        $idPembelian = $_GET['delete'];

        // Delete Pembelian
        $pembelianObj->deletePembelian($idPembelian);
    }

    // Get all Pembelian data
    $pembelianList = $pembelianObj->getAllPembelian();
    ?>

    <!-- Display table of Pembelian -->
    <table>
        <tr>
            <th>ID Pembelian</th>
            <th>ID Barang</th>
            <th>Jumlah Pembelian</th>
            <th>ID Pengguna</th>
            <th>ID Supplier</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($pembelianList as $pembelian): ?>
        <tr>
            <td><?php echo $pembelian['IdPembelian']; ?></td>
            <td><?php echo $pembelian['IdBarang']; ?></td>
            <td><?php echo $pembelian['JumlahPembelian']; ?></td>
            <td><?php echo $pembelian['IdPengguna']; ?></td>
            <td><?php echo $pembelian['IdSupplier']; ?></td>
            <td>
                <a href="?delete=<?php echo $pembelian['IdPembelian']; ?>">Delete</a>
                <button onclick="editPembelian(<?php echo $pembelian['IdPembelian']; ?>, <?php echo $pembelian['JumlahPembelian']; ?>, <?php echo $pembelian['IdPengguna']; ?>, <?php echo $pembelian['IdSupplier']; ?>)">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form for adding or updating Pembelian -->
    <form id="pembelianForm" method="post">
        <input type="hidden" id="idPembelian" name="id_pembelian" value="">
        <input type="text" id="idBarang" name="id_barang" placeholder="ID Barang" required>
        <input type="text" id="jumlahPembelian" name="jumlah_pembelian" placeholder="Jumlah Pembelian" required>
        <input type="text" id="idPengguna" name="id_pengguna" placeholder="ID Pengguna" required>
        <input type="text" id="idSupplier" name="id_supplier" placeholder="ID Supplier" required>
        <button type="submit" id="submitBtn" name="submit">Tambah Pembelian</button>
        <button type="submit" id="updateBtn" name="update" style="display: none;">Update Pembelian</button>
    </form>

    <script>
        // Function to fill form with Pembelian data for updating
        function editPembelian(idPembelian, jumlahPembelian, hargaBeli, idPengguna, idSupplier) {
            document.getElementById("idPembelian").value = idPembelian;
            document.getElementById("jumlahPembelian").value = jumlahPembelian;
            document.getElementById("idPengguna").value = idPengguna;
            document.getElementById("idSupplier").value = idSupplier;
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        }
    </script>
</body>
</html>
