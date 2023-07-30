<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pelanggan</title>
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

    <h1>Daftar Pelanggan</h1>

    <?php
    // Include database connection
    require_once('db_config.php');

    // Include the Pelanggan class
    require_once('./controllers/Pelanggan.php');

    // Create Pelanggan object with the database connection
    $pelangganObj = new Pelanggan($conn);

    // Check if form submitted for adding new Pelanggan
    if (isset($_POST['submit'])) {
        $pelangganName = $_POST['pelanggan_name'];
        $pelangganAddress = $_POST['pelanggan_address'];
        $supplierId = $_POST['supplier_id'];

        // Create new Pelanggan
        $pelangganObj->createPelanggan($pelangganName, $pelangganAddress, $supplierId);
    }

    // Check if form submitted for updating Pelanggan
    if (isset($_POST['update'])) {
        $pelangganId = $_POST['pelanggan_id'];
        $pelangganName = $_POST['pelanggan_name'];
        $pelangganAddress = $_POST['pelanggan_address'];
        $supplierId = $_POST['supplier_id'];

        // Update Pelanggan
        $pelangganObj->updatePelanggan($pelangganId, $pelangganName, $pelangganAddress, $supplierId);
    }

    // Check if delete button clicked
    if (isset($_GET['delete'])) {
        $pelangganId = $_GET['delete'];

        // Delete Pelanggan
        $pelangganObj->deletePelanggan($pelangganId);
    }

    // Get all Pelanggan data
    $pelangganList = $pelangganObj->getAllPelanggan();
    ?>

    <!-- Display table of Pelanggan -->
    <table>
        <tr>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat Pelanggan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($pelangganList as $pelanggan): ?>
        <tr>
            <td><?php echo $pelanggan['pelanggan_id']; ?></td>
            <td><?php echo $pelanggan['pelanggan_name']; ?></td>
            <td><?php echo $pelanggan['pelanggan_address']; ?></td>
            <td>
                <a href="?delete=<?php echo $pelanggan['pelanggan_id']; ?>">Delete</a>
                <button onclick="editPelanggan(<?php echo $pelanggan['pelanggan_id']; ?>, '<?php echo $pelanggan['pelanggan_name']; ?>', '<?php echo $pelanggan['pelanggan_address']; ?>')">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form for adding or updating Pelanggan -->
    <form id="pelangganForm" method="post">
        <input type="hidden" id="pelangganId" name="pelanggan_id" value="">
        <input type="text" id="pelangganName" name="pelanggan_name" placeholder="Nama Pelanggan" required>
        <textarea id="pelangganAddress" name="pelanggan_address" placeholder="Alamat Pelanggan" required></textarea>
        <input type="number" id="supplierId" name="supplier_id" placeholder="Supplier ID" required>
        <button type="submit" id="submitBtn" name="submit">Tambah Pelanggan</button>
        <button type="submit" id="updateBtn" name="update" style="display: none;">Update Pelanggan</button>
    </form>

    <script>
        // Function to fill form with Pelanggan data for updating
        function editPelanggan(pelangganId, pelangganName, pelangganAddress) {
            document.getElementById("pelangganId").value = pelangganId;
            document.getElementById("pelangganName").value = pelangganName;
            document.getElementById("pelangganAddress").value = pelangganAddress;
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        }
    </script>
</body>
</html>
