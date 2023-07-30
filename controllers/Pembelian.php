<?php
class Pembelian {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPembelian($jumlahPembelian, $idPengguna, $idSupplier, $idBarang) {
        $sql = "INSERT INTO Pembelian (JumlahPembelian, IdPengguna, IdSupplier, IdBarang) VALUES ($jumlahPembelian, $idPengguna, $idSupplier, $idBarang)";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function getPembelianById($idPembelian) {
        $sql = "SELECT * FROM Pembelian WHERE IdPembelian = $idPembelian";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updatePembelian($idPembelian, $jumlahPembelian, $idPengguna, $idSupplier, $idBarang) {
        $sql = "UPDATE Pembelian SET JumlahPembelian = $jumlahPembelian, IdPengguna = $idPengguna, IdSupplier = $idSupplier, IdBarang = $idBarang WHERE IdPembelian = $idPembelian";
        return $this->conn->query($sql);
    }

    public function deletePembelian($idPembelian) {
        $sql = "DELETE FROM Pembelian WHERE IdPembelian = $idPembelian";
        return $this->conn->query($sql);
    }

    public function getAllPembelian() {
        $sql = "SELECT * FROM Pembelian";
        $result = $this->conn->query($sql);
        $pembelianList = array();
        while ($row = $result->fetch_assoc()) {
            $pembelianList[] = $row;
        }
        return $pembelianList;
    }
}
?>
