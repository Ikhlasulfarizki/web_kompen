<?php
class Auth{
    private $conn;
    function __construct($db){
        $this->conn = $db->conn;
    }

    public function login($username, $password){
        // $admin = $this->checkUser("tb_admin", "username", $username, $password);
        // if($admin) return ["role" => "admin" , "data" => $admin];
        $dosen = $this->checkUser("tb_dosen", "nip", $username, $password);
        if($dosen) return ["role" => "dosen" , "data" => $dosen];
        $mahasiswa = $this->checkUser("tb_mahasiswa", "npm", $username, $password);
        if($mahasiswa) return ["role" => "mahasiswa" , "data" => $mahasiswa];
    }

    private function checkUser($table, $field, $username, $password){
        $query = $this->conn->prepare("SELECT * FROM $table WHERE $field = ? AND password = ?");
        $query->bind_param("is", $username, $password);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : false;
    }
}
?>