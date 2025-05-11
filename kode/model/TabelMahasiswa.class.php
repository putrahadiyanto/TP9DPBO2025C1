<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

// Kelas yang berisikan tabel dari mahasiswa
class TabelMahasiswa extends DB
{
	// READ - Get all mahasiswa
	function getMahasiswa()
	{
		// Query mysql select data mahasiswa
		$query = "SELECT * FROM mahasiswa";
		
		// Mengeksekusi query dengan PDO
		return $this->execute($query);
	}
	
	// READ - Get a single mahasiswa by ID
	function getMahasiswaById($id)
	{
		// Query select mahasiswa by id
		$query = "SELECT * FROM mahasiswa WHERE id = ?";
		
		// Mengeksekusi query dengan PDO
		return $this->execute($query, [$id]);
	}
	
	// CREATE - Insert new mahasiswa
	function insertMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		// Query insert mahasiswa
		$query = "INSERT INTO mahasiswa (nim, nama, tempat, tl, gender, email, telp) 
				 VALUES (?, ?, ?, ?, ?, ?, ?)";
		
		// Mengeksekusi query dengan PDO
		return $this->execute($query, [$nim, $nama, $tempat, $tl, $gender, $email, $telp]);
	}
	
	// UPDATE - Update existing mahasiswa
	function updateMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		// Query update mahasiswa
		$query = "UPDATE mahasiswa 
				 SET nim = ?, nama = ?, tempat = ?, tl = ?, gender = ?, email = ?, telp = ? 
				 WHERE id = ?";
		
		// Mengeksekusi query dengan PDO
		return $this->execute($query, [$nim, $nama, $tempat, $tl, $gender, $email, $telp, $id]);
	}
	
	// DELETE - Delete a mahasiswa
	function deleteMahasiswa($id)
	{
		// Query delete mahasiswa
		$query = "DELETE FROM mahasiswa WHERE id = ?";
		
		// Mengeksekusi query dengan PDO
		return $this->execute($query, [$id]);
	}
}
