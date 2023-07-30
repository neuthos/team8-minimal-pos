<?php
class HakAkses {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createHakAkses($namaAkses, $keterangan) {
        $sql = "INSERT INTO HakAkses (NamaAkses, Keterangan) VALUES ('$namaAkses', '$keterangan')";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function getHakAksesById($idAkses) {
        $sql = "SELECT * FROM HakAkses WHERE IdAkses = $idAkses";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateHakAkses($idAkses, $namaAkses, $keterangan) {
        $sql = "UPDATE HakAkses SET NamaAkses = '$namaAkses', Keterangan = '$keterangan' WHERE IdAkses = $idAkses";
        return $this->conn->query($sql);
    }

    public function deleteHakAkses($idAkses) {
        $sql = "DELETE FROM HakAkses WHERE IdAkses = $idAkses";
        return $this->conn->query($sql);
    }

    public function getAllHakAkses() {
        $sql = "SELECT * FROM HakAkses";
        $result = $this->conn->query($sql);
        $hakAksesList = array();
        while ($row = $result->fetch_assoc()) {
            $hakAksesList[] = $row;
        }
        return $hakAksesList;
    }
}
?>
