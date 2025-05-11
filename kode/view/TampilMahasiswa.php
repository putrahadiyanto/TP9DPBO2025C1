<?php

/******************************************
 Asisten Pemrogaman 13 & 14
 ******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
			<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
			<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
			<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>			<td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
			<td>
				<a href='index.php?page=form&action=edit&id=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-warning btn-sm'>Edit</a>
				<a href='process.php?action=delete&id=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
			</td>
			</tr>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function tampilForm($action = 'add', $id = null)
	{
		// Membaca template form.html
		$this->tpl = new Template("templates/form.html");

		// Set nilai default untuk semua field
		$nim_value = "";
		$nama_value = "";
		$tempat_value = "";
		$tl_value = "";
		$gender_l_selected = "";
		$gender_p_selected = "";
		$email_value = "";
		$telp_value = "";
		$hidden_id_field = "";

		// Tentukan judul form dan action berdasarkan mode (add atau edit)
		if ($action === 'edit' && $id !== null) {
			// Mode edit, ambil data mahasiswa berdasarkan ID
			$this->prosesmahasiswa->prosesDataMahasiswa();			// Cari mahasiswa dengan ID yang sesuai
			for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
				if ($this->prosesmahasiswa->getId($i) == $id) {
					// Isi nilai form dengan data mahasiswa yang ditemukan
					$nim_value = $this->prosesmahasiswa->getNim($i);
					$nama_value = $this->prosesmahasiswa->getNama($i);
					$tempat_value = $this->prosesmahasiswa->getTempat($i);
					$tl_value = $this->prosesmahasiswa->getTl($i);

					// Atur pilihan gender
					if ($this->prosesmahasiswa->getGender($i) === 'Laki-laki') {
						$gender_l_selected = "selected";
					} else if ($this->prosesmahasiswa->getGender($i) === 'Perempuan') {
						$gender_p_selected = "selected";
					}

					$email_value = $this->prosesmahasiswa->getEmail($i);
					$telp_value = $this->prosesmahasiswa->getTelp($i);

					// Tambahkan hidden field untuk ID
					$hidden_id_field = "<input type='hidden' name='id' value='" . $id . "'>";

					break;
				}
			}

			// Set judul form dan header untuk mode edit
			$this->tpl->replace("FORM_TITLE", "Edit Mahasiswa");
			$this->tpl->replace("FORM_HEADER", "EDIT DATA MAHASISWA");
			$this->tpl->replace("FORM_ACTION", "process.php?action=update");
			$this->tpl->replace("SUBMIT_TEXT", "Update");
		} else {
			// Mode tambah baru
			$this->tpl->replace("FORM_TITLE", "Tambah Mahasiswa");
			$this->tpl->replace("FORM_HEADER", "TAMBAH DATA MAHASISWA");
			$this->tpl->replace("FORM_ACTION", "process.php?action=add");
			$this->tpl->replace("SUBMIT_TEXT", "Simpan");
		}

		// Replace semua placeholder di template
		$this->tpl->replace("HIDDEN_ID_FIELD", $hidden_id_field);
		$this->tpl->replace("NIM_VALUE", $nim_value);
		$this->tpl->replace("NAMA_VALUE", $nama_value);
		$this->tpl->replace("TEMPAT_VALUE", $tempat_value);
		$this->tpl->replace("TL_VALUE", $tl_value);
		$this->tpl->replace("GENDER_L_SELECTED", $gender_l_selected);
		$this->tpl->replace("GENDER_P_SELECTED", $gender_p_selected);
		$this->tpl->replace("EMAIL_VALUE", $email_value);
		$this->tpl->replace("TELP_VALUE", $telp_value);

		// Menampilkan ke layar
		$this->tpl->write();
	}
}
