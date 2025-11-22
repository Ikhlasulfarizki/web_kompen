<?php
class Tugas{
    private $conn;
    private $terdaftarObj;
    function __construct($db, $terdaftar){
        $this->conn = $db->conn;
        $this->terdaftarObj = $terdaftar;
    }

    public function allTugas(){
        $query = $this->conn->query("SELECT * FROM tb_tugas");
        $count = $query->num_rows;
        $data = [];
        while($row = $query->fetch_assoc()){
            $data[] = $row;
        }
        return [
            "count"=> $count,
            "data" => $data
        ];
    }

    public function tugasTerdaftar($id_mhs){
    $dataTerdaftar = $this->terdaftarObj->mhsTerdaftar($id_mhs);

    if ($dataTerdaftar["count"] > 0) {
        $tugas = [];
        foreach ($dataTerdaftar["data"] as $row) {
            $id_tugas = $row["id_tugas"];
    
            $query = $this->conn->prepare("SELECT * FROM tb_tugas WHERE id = ?");
            $query->bind_param("i", $id_tugas);
            $query->execute();
            $result = $query->get_result();
    
            if ($detail = $result->fetch_assoc()) {
                $tugas[] = $detail;
            }
        }
    
        return [
            "count" => count($tugas),
            "data" => $tugas
        ];
    }else{
        return [
            "count" => 0,
            "data" => []
        ];
    }
    
}

}
?>