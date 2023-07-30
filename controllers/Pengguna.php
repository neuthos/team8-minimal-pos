<?php
class Pengguna {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPengguna($namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat, $idAkses) {
        $sql = "INSERT INTO Pengguna (NamaPengguna, Password, NamaDepan, NamaBelakang, NoHp, Alamat, IdAkses) VALUES ('$namaPengguna', '$password', '$namaDepan', '$namaBelakang', '$noHp', '$alamat', $idAkses)";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function getPenggunaById($idPengguna) {
        $sql = "SELECT * FROM Pengguna WHERE IdPengguna = $idPengguna";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updatePengguna($idPengguna, $namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat, $idAkses) {
        $sql = "UPDATE Pengguna SET NamaPengguna = '$namaPengguna', Password = '$password', NamaDepan = '$namaDepan', NamaBelakang = '$namaBelakang', NoHp = '$noHp', Alamat = '$alamat', IdAkses = $idAkses WHERE IdPengguna = $idPengguna";
        return $this->conn->query($sql);
    }

    public function deletePengguna($idPengguna) {
        $sql = "DELETE FROM Pengguna WHERE IdPengguna = $idPengguna";
        return $this->conn->query($sql);
    }

    public function getAllPengguna() {
        $sql = "SELECT * FROM Pengguna";
        $result = $this->conn->query($sql);
        $penggunaList = array();
        while ($row = $result->fetch_assoc()) {
            $penggunaList[] = $row;
        }
        return $penggunaList;
    }
}
?>
