<?php
class Barang {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createBarang($namaBarang, $keterangan, $satuan, $idPengguna, $hargaBeli, $hargaJual) {
        $sql = "INSERT INTO Barang (NamaBarang, Keterangan, Satuan, IdPengguna, HargaBeli, HargaJual) VALUES ('$namaBarang', '$keterangan', '$satuan', $idPengguna, $hargaBeli, $hargaJual)";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function getBarangById($idBarang) {
        $sql = "SELECT * FROM Barang WHERE IdBarang = $idBarang";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateBarang($idBarang, $namaBarang, $keterangan, $satuan, $idPengguna, $hargaBeli, $hargaJual) {
        $sql = "UPDATE Barang SET NamaBarang = '$namaBarang', Keterangan = '$keterangan', Satuan = '$satuan', IdPengguna = $idPengguna, HargaBeli = $hargaBeli, HargaJual = '$hargaJual' WHERE IdBarang = $idBarang";
        return $this->conn->query($sql);
    }

    public function deleteBarang($idBarang) {
        $sql = "DELETE FROM Barang WHERE IdBarang = $idBarang";
        return $this->conn->query($sql);
    }

    public function getAllBarang() {
        $sql = "SELECT * FROM Barang";
        $result = $this->conn->query($sql);
        $barangList = array();
        while ($row = $result->fetch_assoc()) {
            $barangList[] = $row;
        }
        return $barangList;
    }
}
?>
