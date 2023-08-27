<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Aplikasi Mahasiswa CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php
    require_once 'MahasiswaController.php';

    $mahasiswaController = new MahasiswaController();

    if (isset($_POST['submit'])) {
        $mahasiswaController->simpanMahasiswa();
    }

    if (isset($_POST['update'])) {
        $mahasiswaController->updateMahasiswa();
    }

    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        $mahasiswaController->editMahasiswa($_GET['id']);
    }

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $mahasiswaController->hapusMahasiswa($_GET['id']);
    }
    ?>

    <div class="container">
       
        <?php
        if (!isset($_GET['action']) || ($_GET['action'] != 'edit' && $_GET['action'] != 'add')) {
            ?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-md">
                <a class="navbar-brand" href="#">CRUD Data Mahasiswa</a>
            </div>
        </nav>

        <a href="?action=add" class="add-button">Tambah Mahasiswa</a>
        <br><br>
        <table class="table table-striped">
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
            <?php
            $mahasiswaController->tampilDaftarMahasiswa();
            ?>
        </table>
        <?php
        } elseif($_GET['action'] == 'edit') {
        }else{
            $mahasiswaController->tampilFormMahasiswaAdd();
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
