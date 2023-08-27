<?php
require_once 'Mahasiswa.php';

class MahasiswaController {
    private $db;
    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'dn_mahasiswa');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function tampilDaftarMahasiswa() {
        $query = "SELECT * FROM mahasiswa";
        $result = $this->db->query($query);

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['nim'] . '</td>';
            echo '<td>' . $row['nama'] . '</td>';
            echo '<td><a href="?action=edit&id=' . $row['id'] . '">Edit</a> | <a href="?action=delete&id=' . $row['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
    }

    public function tampilFormMahasiswa($mahasiswa = null) {
        $isEdit = isset($_GET['action']) && $_GET['action'] == 'edit';
        $nim = $isEdit && $mahasiswa ? $mahasiswa->nim : '';
        $nama = $isEdit && $mahasiswa ? $mahasiswa->nama : '';
    
        echo '<div class="form-container">';
        echo '<h2>' . ($isEdit ? 'Edit Mahasiswa' : 'Tambah Mahasiswa') . '</h2>';
        echo '<form method="post">';
        echo '<input type="text" name="nim" placeholder="NIM" value="' . $nim . '">';
        echo '<input type="text" name="nama" placeholder="Nama" value="' . $nama . '">';
        echo '<input type="hidden" name="id" value="' . ($isEdit && $mahasiswa ? $mahasiswa->id : '') . '">';
        echo '<input type="submit" name="update" value="Update">';
        echo '</form>';
        echo '</div>';
    }

    public function tampilFormMahasiswaAdd($mahasiswa = null) {
        echo '<div class="form-container">';
        echo '<h2>' . 'Tambah Mahasiswa'. '</h2>';
        echo '<form method="post">';
        echo '<input type="text" name="nim" placeholder="NIM" value="">';
        echo '<input type="text" name="nama" placeholder="Nama" value="">';
        echo '<input type="submit" name="submit" value="Simpan">';
        echo '</form>';
        echo '</div>';
    }

    public function simpanMahasiswa() {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];

        $query = "INSERT INTO mahasiswa (nim, nama) VALUES ('$nim', '$nama')";
        $this->db->query($query);

        header('Location: index.php');
    }

    public function editMahasiswa($id) {
        $query = "SELECT * FROM mahasiswa WHERE id = $id";
        $result = $this->db->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mahasiswa = new Mahasiswa($row['id'], $row['nim'], $row['nama']);
            $this->tampilFormMahasiswa($mahasiswa);
        } else {
            echo "Mahasiswa tidak ditemukan.";
        }
    }
    

    public function updateMahasiswa() {
        $id = $_POST['id'];
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];

        $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama' WHERE id = $id";
        $this->db->query($query);

        header('Location: index.php');
    }

    public function hapusMahasiswa($id) {
        $query = "DELETE FROM mahasiswa WHERE id = $id";
        $this->db->query($query);

        header('Location: index.php');
    }
}
?>
