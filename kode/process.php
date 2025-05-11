<?php

include("presenter/ProsesMahasiswa.php");

// Inisialisasi presenter
$presenter = new ProsesMahasiswa();

// Mendapatkan aksi dari URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Memproses berdasarkan jenis aksi
switch ($action) {
    case 'add':
        // Membuat catatan mahasiswa baru
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mendapatkan data form
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $tempat = $_POST['tempat'];
            $tl = $_POST['tl'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $telp = $_POST['telp'];

            // Membuat catatan mahasiswa
            $result = $presenter->createDataMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp);

            // Mengalihkan kembali ke index dengan status
            header("Location: index.php?status=added");
            exit;
        }
        break;

    case 'update':
        // Memperbarui catatan mahasiswa yang ada
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mendapatkan data form termasuk ID
            $id = $_POST['id'];
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $tempat = $_POST['tempat'];
            $tl = $_POST['tl'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $telp = $_POST['telp'];

            // Memperbarui catatan mahasiswa
            $result = $presenter->updateDataMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp);

            // Mengalihkan kembali ke index dengan status
            header("Location: index.php?status=updated");
            exit;
        }
        break;

    case 'delete':
        // Menghapus catatan mahasiswa
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Menghapus catatan mahasiswa
            $result = $presenter->deleteDataMahasiswa($id);

            // Mengalihkan kembali ke index dengan status
            header("Location: index.php?status=deleted");
            exit;
        }
        break;

    default:
        // Aksi tidak valid, alihkan ke index
        header("Location: index.php");
        exit;
}

// Jika eksekusi mencapai sini, alihkan ke index (fallback)
header("Location: index.php");
exit;
