<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h1>Aplikasi Mahasiswa CRUD</h1>
        <table>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
            <?php
            $mahasiswaController->tampilDaftarMahasiswa();
            ?>
        </table>
        <a href="?action=add" class="add-button">Tambah Mahasiswa</a>
        <?php
        } elseif($_GET['action'] == 'edit') {
        }else{
            $mahasiswaController->tampilFormMahasiswaAdd();
        }
        ?>
    </div>
</body>
</html>
