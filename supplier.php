<!-- view_supplier.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Supplier</title>
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

    <h1>Daftar Supplier</h1>

    <?php
    // Include database connection
    require_once('db_config.php');

    // Include the Supplier class
    require_once('./controllers/Supplier.php');

    // Create Supplier object with the database connection
    $supplierObj = new Supplier($conn);

    // Check if form submitted for adding new Supplier
    if (isset($_POST['submit'])) {
        $supplierName = $_POST['supplier_name'];
        $supplierAddress = $_POST['supplier_address'];

        // Create new Supplier
        $supplierObj->createSupplier($supplierName, $supplierAddress);
    }

    // Check if form submitted for updating Supplier
    if (isset($_POST['update'])) {
        $supplierId = $_POST['supplier_id'];
        $supplierName = $_POST['supplier_name'];
        $supplierAddress = $_POST['supplier_address'];

        // Update Supplier
        $supplierObj->updateSupplier($supplierId, $supplierName, $supplierAddress);
    }

    // Check if delete button clicked
    if (isset($_GET['delete'])) {
        $supplierId = $_GET['delete'];

        // Delete Supplier
        $supplierObj->deleteSupplier($supplierId);
    }

    // Get all Supplier data
    $supplierList = $supplierObj->getAllSupplier();
    ?>

    <!-- Display table of Supplier -->
    <table>
        <tr>
            <th>Supplier ID</th>
            <th>Nama Supplier</th>
            <th>Alamat Supplier</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($supplierList as $supplier): ?>
        <tr>
            <td><?php echo $supplier['supplier_id']; ?></td>
            <td><?php echo $supplier['supplier_name']; ?></td>
            <td><?php echo $supplier['supplier_address']; ?></td>
            <td>
                <a href="?delete=<?php echo $supplier['supplier_id']; ?>">Delete</a>
                <button onclick="editSupplier(<?php echo $supplier['supplier_id']; ?>, '<?php echo $supplier['supplier_name']; ?>', '<?php echo $supplier['supplier_address']; ?>')">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form for adding or updating Supplier -->
    <form id="supplierForm" method="post">
        <input type="hidden" id="supplierId" name="supplier_id" value="">
        <input type="text" id="supplierName" name="supplier_name" placeholder="Nama Supplier" required>
        <textarea id="supplierAddress" name="supplier_address" placeholder="Alamat Supplier" required></textarea>
        <button type="submit" id="submitBtn" name="submit">Tambah Supplier</button>
        <button type="submit" id="updateBtn" name="update" style="display: none;">Update Supplier</button>
    </form>

    <script>
        // Function to fill form with Supplier data for updating
        function editSupplier(supplierId, supplierName, supplierAddress) {
            document.getElementById("supplierId").value = supplierId;
            document.getElementById("supplierName").value = supplierName;
            document.getElementById("supplierAddress").value = supplierAddress;
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        }
    </script>
</body>
</html>
