<?php
class Mahasiswa {
    public $id;
    public $nim;
    public $nama;

    public function __construct($id, $nim, $nama) {
        $this->id = $id;
        $this->nim = $nim;
        $this->nama = $nama;
    }
}
?>
