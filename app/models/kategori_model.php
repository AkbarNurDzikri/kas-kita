<?php

class Kategori_model
{
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getCategories($jenisKategori) {
		$this->db->query("SELECT id, nama_kategori FROM categories WHERE user_id = :userLogin AND jenis_kategori = :jenisKategori");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('jenisKategori', $jenisKategori);
		return $this->db->resultSet();
	}

	public function getCategoriesOut() {
		$this->db->query("SELECT id, nama_kategori FROM categories WHERE user_id = :userLogin AND jenis_kategori = :jenisKategori");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('jenisKategori', 'Pengeluaran');
		return $this->db->resultSet();
	}

	public function getCategoriesIn() {
		$this->db->query("SELECT id, nama_kategori FROM categories WHERE user_id = :userLogin AND jenis_kategori = :jenisKategori");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('jenisKategori', 'Pemasukan');
		return $this->db->resultSet();
	}

	public function getExistCategory($data) {
		$this->db->query("SELECT * FROM categories WHERE user_id = :userLogin AND nama_kategori = :kategoriNama AND jenis_kategori = :jenisKategori");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('kategoriNama', $data['nama_kategori']);
		$this->db->bind('jenisKategori', $data['jenis_kategori']);
		return $this->db->single();
	}

	public function createCategory($data) {
		$query = "INSERT INTO categories VALUES (NULL, :user_id, :nama_kategori, :jenis_kategori, :created_at, :updated_at)";

		$this->db->query($query);
		$this->db->bind('user_id', $_SESSION['userInfo']['id']);
		$this->db->bind('nama_kategori', $data['nama_kategori']);
		$this->db->bind('jenis_kategori', $data['jenis_kategori']);
		$this->db->bind('created_at', date('Y-m-d H:i:s'));
		$this->db->bind('updated_at', NULL);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function getCategory($namaKategori) {
		$this->db->query("SELECT * FROM categories WHERE nama_kategori = :kategoriNama AND user_id = :userId");

		$this->db->bind('kategoriNama', $namaKategori);
		$this->db->bind('userId', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}

	public function updateCategory($data) {
		$query = "UPDATE categories SET
				nama_kategori = :nama_kategori,
				updated_at = :updated_at
		WHERE nama_kategori = :pilih_kategori AND user_id = :userId
		";

		$this->db->query($query);
		$this->db->bind('nama_kategori', $data['nama_kategori_edit']);
		$this->db->bind('updated_at', date('Y-m-d H:i:s'));
		$this->db->bind('pilih_kategori', $data['pilih_kategori']);
		$this->db->bind('userId', $_SESSION['userInfo']['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteCategory($id) {
		$query = "DELETE FROM categories WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function getPemasukanAll() {
		$this->db->query("SELECT SUM(`pemasukan`) AS total_pemasukan FROM kas_kita WHERE user_id = :userLogin");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}
}
