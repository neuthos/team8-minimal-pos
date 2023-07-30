<?php
class Penjualan {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPenjualan($jumlahPenjualan, $idPengguna, $idPelanggan, $idBarang) {
        $sql = "INSERT INTO Penjualan (JumlahPenjualan, IdPengguna, IdPelanggan, IdBarang) VALUES ($jumlahPenjualan, $idPengguna, $idPelanggan, $idBarang)";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function getPenjualanById($idPenjualan) {
        $sql = "SELECT * FROM Penjualan WHERE IdPenjualan = $idPenjualan";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updatePenjualan($idPenjualan, $jumlahPenjualan, $idPengguna, $idPelanggan, $idBarang) {
        $sql = "UPDATE Penjualan SET JumlahPenjualan = $jumlahPenjualan, IdPengguna = $idPengguna, IdPelanggan = $idPelanggan, IdBarang = '$idBarang' WHERE IdPenjualan = $idPenjualan";
        return $this->conn->query($sql);
    }

    public function deletePenjualan($idPenjualan) {
        $sql = "DELETE FROM Penjualan WHERE IdPenjualan = $idPenjualan";
        return $this->conn->query($sql);
    }

    public function getAllPenjualan() {
        $sql = "SELECT * FROM Penjualan";
        $result = $this->conn->query($sql);
        $penjualanList = array();
        while ($row = $result->fetch_assoc()) {
            $penjualanList[] = $row;
        }
        return $penjualanList;
    }
}
?>
