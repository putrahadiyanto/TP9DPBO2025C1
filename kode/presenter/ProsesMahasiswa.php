<?php

include("KontrakPresenter.php");

/******************************************
 Asisten Pemrogaman 13 & 14
 ******************************************/

class ProsesMahasiswa implements KontrakPresenter
{
	private $tabelmahasiswa;
	private $data = [];

	function __construct()
	{
		// Konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelmahasiswa = new TabelMahasiswa($db_host, $db_user, $db_password, $db_name); // instansi TabelMahasiswa
			$this->data = array(); // instansi list untuk data Mahasiswa
		} catch (Exception $e) {
			echo "yah error" . $e->getMessage();
		}
	}

	function prosesDataMahasiswa()
	{
		try {
			// mengambil data di tabel Mahasiswa
			$this->tabelmahasiswa->open();
			$this->tabelmahasiswa->getMahasiswa();

			while ($row = $this->tabelmahasiswa->getResult()) {
				// ambil hasil query
				$mahasiswa = new Mahasiswa(); // instansiasi objek mahasiswa untuk setiap data mahasiswa
				$mahasiswa->setId($row['id']); // mengisi id
				$mahasiswa->setNim($row['nim']); // mengisi nim
				$mahasiswa->setNama($row['nama']); // mengisi nama
				$mahasiswa->setTempat($row['tempat']); // mengisi tempat
				$mahasiswa->setTl($row['tl']); // mengisi tl
				$mahasiswa->setGender($row['gender']); // mengisi gender
				$mahasiswa->setEmail($row['email']); // mengisi email
				$mahasiswa->setTelp($row['telp']); // mengisi telp

				$this->data[] = $mahasiswa; // tambahkan data mahasiswa ke dalam list
			}
			// Tutup koneksi
			$this->tabelmahasiswa->close();
		} catch (Exception $e) {
			// memproses error
			echo "yah error part 2" . $e->getMessage();
		}
	}
	function createDataMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			// Buka koneksi database
			$this->tabelmahasiswa->open();
			// Panggil method insertMahasiswa dari TabelMahasiswa
			$this->tabelmahasiswa->insertMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp);
			// Tutup koneksi
			$this->tabelmahasiswa->close();

			// Perbarui data setelah penambahan
			$this->prosesDataMahasiswa();

			return true;
		} catch (Exception $e) {
			echo "Terjadi kesalahan saat menambah data: " . $e->getMessage();
			return false;
		}
	}

	function updateDataMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			// Buka koneksi database
			$this->tabelmahasiswa->open();
			// Panggil method updateMahasiswa dari TabelMahasiswa
			$this->tabelmahasiswa->updateMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp);
			// Tutup koneksi
			$this->tabelmahasiswa->close();

			// Perbarui data setelah pembaruan
			$this->prosesDataMahasiswa();

			return true;
		} catch (Exception $e) {
			echo "Terjadi kesalahan saat memperbarui data: " . $e->getMessage();
			return false;
		}
	}

	function deleteDataMahasiswa($id)
	{
		try {
			// Buka koneksi database
			$this->tabelmahasiswa->open();			// Panggil method deleteMahasiswa dari TabelMahasiswa
			$this->tabelmahasiswa->deleteMahasiswa($id);
			// Tutup koneksi
			$this->tabelmahasiswa->close();

			// Perbarui data setelah penghapusan
			$this->prosesDataMahasiswa();

			return true;
		} catch (Exception $e) {
			echo "Terjadi kesalahan saat menghapus data: " . $e->getMessage();
			return false;
		}
	}
	function getId($i)
	{
		// mengembalikan id mahasiswa dengan indeks ke i
		return $this->data[$i]->getId();
	}
	function getNim($i)
	{
		// mengembalikan nim mahasiswa dengan indeks ke i
		return $this->data[$i]->getNim();
	}
	function getNama($i)
	{
		// mengembalikan nama mahasiswa dengan indeks ke i
		return $this->data[$i]->getNama();
	}
	function getTempat($i)
	{
		// mengembalikan tempat mahasiswa dengan indeks ke i
		return $this->data[$i]->getTempat();
	}
	function getTl($i)
	{
		// mengembalikan tanggal lahir(TL) mahasiswa dengan indeks ke i
		return $this->data[$i]->getTl();
	}
	function getGender($i)
	{
		// mengembalikan gender mahasiswa dengan indeks ke i
		return $this->data[$i]->getGender();
	}
	function getEmail($i)
	{
		return $this->data[$i]->getEmail();
	}
	function getTelp($i)
	{
		return $this->data[$i]->getTelp();
	}
	function getSize()
	{
		return sizeof($this->data);
	}
}
