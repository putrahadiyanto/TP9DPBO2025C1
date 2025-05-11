<?php

/******************************************
 Asisten Pemrogaman 13 & 14
 ******************************************/

include("view/TampilMahasiswa.php");

// Membuat instance baru TampilMahasiswa
$tp = new TampilMahasiswa();

// Memeriksa apakah kita berada di mode form
if (isset($_GET['page']) && $_GET['page'] === 'form') {
    // Mode tampilan form

    // Mendapatkan jenis aksi dari URL (tambah atau edit)
    $action = isset($_GET['action']) ? $_GET['action'] : 'add';

    // Untuk mode edit, dapatkan ID dari URL
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Menampilkan form
    $tp->tampilForm($action, $id);
} else {
    // Mode default - menampilkan tabel
    $data = $tp->tampil();
}
