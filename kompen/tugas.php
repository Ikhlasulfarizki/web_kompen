<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        session_start();
        include "classes/databases.php";
        include "classes/tb_tugas.php";
        include "classes/tb_terdaftar.php";
        $id_mhs = $_SESSION["data"]["id"];

        $db = new Database();
        $terdaftar = new Terdaftar($db);
        $tugas = new Tugas($db, $terdaftar);
        $tugasTerdaftar = $tugas->tugasTerdaftar($id_mhs);
        ?>
</head>
<body>
    <table border="1">
        <thead>
            <th>No</th>
            <th>Tugas</th>
            <th>Deskripsi</th>
            <th>Lokasi</th>
            <th>Jam Kompen</th>
            <th>Kuota</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($tugasTerdaftar["data"] as $t){
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $t["nama_tugas"]; ?></td>
                <td><?= $t["deskripsi"]; ?></td>
                <td><?= $t["lokasi"]; ?></td>
                <td><?= $t["jumlah_jam"]; ?></td>
                <td><?= $t["kuota"]; ?></td>
                <td>Status</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>