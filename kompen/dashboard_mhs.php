<?php
session_start();

if (!isset($_SESSION["data"])) {
    header("Location: login.php");
    exit();
}

include "classes/databases.php";
include "classes/tb_tugas.php";
include "classes/tb_terdaftar.php";

$db = new Database();
$terdaftar = new Terdaftar($db);

$id_mhs = $_SESSION["data"]["id"];

if (isset($_POST['daftar'])) {
    $id_tugas = $_POST['id_tugas'];
    $daftar = $terdaftar->daftarKegiatan($id_mhs, $id_tugas);
    echo "<script>alert('" . $daftar['message'] . "');</script>";
}

$mhs_terdaftar = $terdaftar->mhsTerdaftar($id_mhs);
$count_terdaftar = $mhs_terdaftar['count'];

$tugas = new Tugas($db, $terdaftar);
$alltugas = $tugas->allTugas();
$count_tugas = $alltugas['count'];
$data_tugas = $alltugas['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid p-4">
        <div class="row mt-4 mb-4">
            <div class="col-md-4 mb-3">
                <div class="card rounded text-center p-4">
                    <h5>Jumlah Jam Kompen</h5>
                    <span><?= $_SESSION["data"]["jam_kompen"] ?> Jam</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card rounded text-center p-4">
                    <h5>Tugas Tersedia</h5>
                    <span><?= $count_tugas ?></span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card rounded text-center p-4">
                    <a href="tugas.php">
                        <h5>Tugas Terdaftar</h5>
                        <span><?= $count_terdaftar ?></span>
                    </a>
                </div>
            </div>
        </div>
        <hr class="mb-4">
        <div class="row">
            <?php foreach ($data_tugas as $row) { ?>
                <div class="col-md-3">
                    <div class="card rounded-card p-3" style="height: 300px;">
                        <div class="flex-grow-1">
                            <p class="mt-2">
                                <?= $row["nama_tugas"] ?><br>
                                <?= $row["deskripsi"] ?><br>
                                <?= $row["lokasi"] ?>
                            </p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <form method="POST">
                                <input type="hidden" name="id_tugas" value="<?= $row['id'] ?>">
                                <button class="btn btn-primary btn-sm" type="submit" name="daftar">Daftar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>