<?php
class Pelanggan {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPelanggan($pelangganName, $pelangganAddress, $supplierId) {
        $sql = "INSERT INTO Pelanggan (pelanggan_name, pelanggan_address, supplier_id) VALUES ('$pelangganName', '$pelangganAddress', '$supplierId')";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function getPelangganById($pelangganId) {
        $sql = "SELECT * FROM Pelanggan WHERE pelanggan_id = $pelangganId";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updatePelanggan($pelangganId, $pelangganName, $pelangganAddress) {
        $sql = "UPDATE Pelanggan SET pelanggan_name = '$pelangganName', pelanggan_address = '$pelangganAddress' WHERE pelanggan_id = $pelangganId";
        return $this->conn->query($sql);
    }

    public function deletePelanggan($pelangganId) {
        $sql = "DELETE FROM Pelanggan WHERE pelanggan_id = $pelangganId";
        return $this->conn->query($sql);
    }

    public function getAllPelanggan() {
        $sql = "SELECT * FROM Pelanggan";
        $result = $this->conn->query($sql);
        $pelangganList = array();
        while ($row = $result->fetch_assoc()) {
            $pelangganList[] = $row;
        }
        return $pelangganList;
    }
}
?>
