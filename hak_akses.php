<!DOCTYPE html>
<html>
<head>
    <title>Daftar Hak Akses</title>
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

    <h1>Daftar Hak Akses</h1>

    <?php
    require_once('./db_config.php');
    require_once('./controllers/HakAkses.php');

    $hakAksesObj = new HakAkses($conn);

    if (isset($_POST['submit'])) {
        $namaAkses = $_POST['nama_akses'];
        $keterangan = $_POST['keterangan'];

        $hakAksesObj->createHakAkses($namaAkses, $keterangan);
    }

    if (isset($_POST['update'])) {
        $idAkses = $_POST['id_akses'];
        $namaAkses = $_POST['nama_akses'];
        $keterangan = $_POST['keterangan'];
        $hakAksesObj->updateHakAkses($idAkses, $namaAkses, $keterangan);
    }

    if (isset($_GET['delete'])) {
        $idAkses = $_GET['delete'];

        $hakAksesObj->deleteHakAkses($idAkses);
    }

    $hakAksesList = $hakAksesObj->getAllHakAkses();
    ?>

    <table>
        <tr>
            <th>ID Akses</th>
            <th>Nama Akses</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($hakAksesList as $hakAkses): ?>
        <tr>
            <td><?php echo $hakAkses['IdAkses']; ?></td>
            <td><?php echo $hakAkses['NamaAkses']; ?></td>
            <td><?php echo $hakAkses['Keterangan']; ?></td>
            <td>
                <a href="?delete=<?php echo $hakAkses['IdAkses']; ?>">Delete</a>
                <button onclick="editHakAkses(<?php echo $hakAkses['IdAkses']; ?>, '<?php echo $hakAkses['NamaAkses']; ?>', '<?php echo $hakAkses['Keterangan']; ?>')">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form id="hakAksesForm" method="post">
        <input type="hidden" id="idAkses" name="id_akses" value="">
        <input type="text" id="namaAkses" name="nama_akses" placeholder="Nama Akses" required>
        <textarea id="keterangan" name="keterangan" placeholder="Keterangan" required></textarea>
        <button type="submit" id="submitBtn" name="submit">Tambah Hak Akses</button>
        <button type="submit" id="updateBtn" name="update" style="display: none;">Update Hak Akses</button>
    </form>

    <script>
        function editHakAkses(idAkses, namaAkses, keterangan) {
            document.getElementById("idAkses").value = idAkses;
            document.getElementById("namaAkses").value = namaAkses;
            document.getElementById("keterangan").value = keterangan;
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        }
    </script>
</body>
</html>
