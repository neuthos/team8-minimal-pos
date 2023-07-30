<?php
class Supplier {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createSupplier($supplierName, $supplierAddress) {
        $sql = "INSERT INTO supplier (supplier_name, supplier_address) VALUES ('$supplierName', '$supplierAddress')";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function getSupplierById($supplierId) {
        $sql = "SELECT * FROM supplier WHERE supplier_id = $supplierId";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateSupplier($supplierId, $supplierName, $supplierAddress) {
        $sql = "UPDATE supplier SET supplier_name = '$supplierName', supplier_address = '$supplierAddress' WHERE supplier_id = $supplierId";
        return $this->conn->query($sql);
    }

    public function deleteSupplier($supplierId) {
        $sql = "DELETE FROM supplier WHERE supplier_id = $supplierId";
        return $this->conn->query($sql);
    }

    public function getAllSupplier() {
        $sql = "SELECT * FROM supplier";
        $result = $this->conn->query($sql);
        $supplierList = array();
        while ($row = $result->fetch_assoc()) {
            $supplierList[] = $row;
        }
        return $supplierList;
    }
}
?>
