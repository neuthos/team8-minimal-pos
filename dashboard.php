<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Laporan Rugi Laba</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            margin: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .rupiah {
            text-align: right;
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

    <?php
    // Include database connection
    require_once('db_config.php');

    // Include the Barang class
    require_once('./controllers/Barang.php');

    // Create Barang object with the database connection
    $barangObj = new Barang($conn);

    // Get all Barang data
    $barangList = $barangObj->getAllBarang();

    // Calculate total revenue, total cost, and profit
    $totalRevenue = 0;
    $totalCost = 0;

    foreach ($barangList as $barang) {
        // Query to get total sales (jumlah terjual) from Penjualan
        $sqlPenjualan = "SELECT SUM(JumlahPenjualan) AS TotalTerjual FROM Penjualan WHERE IdBarang = {$barang['IdBarang']}";
        $resultPenjualan = $conn->query($sqlPenjualan);
        $rowPenjualan = $resultPenjualan->fetch_assoc();
        $jumlahTerjual = $rowPenjualan['TotalTerjual'];

        // Query to get total purchase (jumlah dibeli) from Pembelian
        $sqlPembelian = "SELECT SUM(JumlahPembelian) AS TotalDibeli FROM Pembelian WHERE IdBarang = {$barang['IdBarang']}";
        $resultPembelian = $conn->query($sqlPembelian);
        $rowPembelian = $resultPembelian->fetch_assoc();
        $jumlahDibeli = $rowPembelian['TotalDibeli'];

        // Calculate total revenue and total cost
        $totalRevenue += $barang['HargaJual'] * $jumlahTerjual;
        $totalCost += $barang['HargaBeli'] * $jumlahDibeli;
    }

    // Calculate profit
    $profit = $totalRevenue - $totalCost;
    ?>

    <div class="dashboard">
        <h2>Total Pendapatan (Revenue): <?php echo "Rp. " . number_format($totalRevenue, 0, ',', '.'); ?></h2>
        <h2>Total Biaya Pembelian (Cost): <?php echo "Rp. " . number_format($totalCost, 0, ',', '.'); ?></h2>
        <h2>Keuntungan (Profit): <?php echo "Rp. " . number_format($profit, 0, ',', '.'); ?></h2>

        <h2>Daftar Barang Terjual</h2>
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Keuntungan</th>
            </tr>
            <?php foreach ($barangList as $barang): ?>
            <tr>
                <td><?php echo $barang['NamaBarang']; ?></td>
                <td><?php echo "Rp. " . number_format($barang['HargaJual'], 0, ',', '.'); ?></td>
                <td><?php echo "Rp. " . number_format($barang['HargaBeli'], 0, ',', '.'); ?></td>
                <td><?php echo "Rp. " . number_format($barang['HargaJual'] - $barang['HargaBeli'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
