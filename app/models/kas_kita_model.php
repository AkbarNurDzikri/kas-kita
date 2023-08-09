<?php

class Kas_kita_model
{
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getKasKeluarByFilter($data) {
		$this->db->query("SELECT * FROM kas_kita AS kas WHERE kas.user_id = :userId AND kas.kategori = :namaKategori AND kas.tanggal BETWEEN :mulai AND :sampai AND kas.pemasukan IS NULL ORDER BY kas.tanggal DESC");


		$this->db->bind('userId', $_SESSION['userInfo']['id']);
		$this->db->bind('namaKategori', $data['nama_kategori_filter']);
		$this->db->bind('mulai', $data['pengeluaran_mulai']);
		$this->db->bind('sampai', $data['pengeluaran_sampai']);
		return $this->db->resultSet();
	}

	public function getKasKeluarAll($data) {
		$this->db->query("SELECT * FROM kas_kita AS kas WHERE kas.user_id = :userId AND kas.pemasukan IS NULL AND kas.tanggal BETWEEN :mulai AND :sampai ORDER BY kas.tanggal DESC");

		$this->db->bind('userId', $_SESSION['userInfo']['id']);
		$this->db->bind('mulai', $data['pengeluaran_mulai']);
		$this->db->bind('sampai', $data['pengeluaran_sampai']);
		return $this->db->resultSet();
	}

	public function getKasMasukByFilter($data) {
		$this->db->query("SELECT * FROM kas_kita AS kas WHERE kas.user_id = :userId AND kas.kategori = :namaKategori AND kas.tanggal BETWEEN :mulai AND :sampai AND kas.pengeluaran IS NULL ORDER BY kas.tanggal DESC");


		$this->db->bind('userId', $_SESSION['userInfo']['id']);
		$this->db->bind('namaKategori', $data['nama_kategori_filter_pemasukan']);
		$this->db->bind('mulai', $data['pemasukan_mulai']);
		$this->db->bind('sampai', $data['pemasukan_sampai']);
		return $this->db->resultSet();
	}

	public function getKasMasukAll($data) {
		$this->db->query("SELECT * FROM kas_kita AS kas WHERE kas.user_id = :userId AND kas.pengeluaran IS NULL AND kas.tanggal BETWEEN :mulai AND :sampai ORDER BY kas.tanggal DESC");

		$this->db->bind('userId', $_SESSION['userInfo']['id']);
		$this->db->bind('mulai', $data['pemasukan_mulai']);
		$this->db->bind('sampai', $data['pemasukan_sampai']);
		return $this->db->resultSet();
	}

	public function createKas($data) {
		$query = "INSERT INTO kas_kita VALUES (NULL, :user_id, :tanggal, :kategori, :keterangan, :pemasukan, :pengeluaran, :created_at, :updated_at)";

		$this->db->query($query);
		$this->db->bind('user_id', $_SESSION['userInfo']['id']);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('kategori', $data['kategori']);
		$this->db->bind('keterangan', $data['keterangan']);
		$this->db->bind('pemasukan', $data['arusKas'] == 'Pemasukan' ? $data['jumlah'] : NULL);
		$this->db->bind('pengeluaran', $data['arusKas'] == 'Pengeluaran' ? $data['jumlah'] : NULL);
		$this->db->bind('created_at', date('Y-m-d H:i:s'));
		$this->db->bind('updated_at', NULL);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function getDataById($id) {
		$this->db->query("SELECT * FROM kas_kita WHERE id = :id");

		$this->db->bind('id', $id);
		return $this->db->resultSet();
	}

	public function updateKas($data) {
		$query = "UPDATE kas_kita SET
				tanggal = :tanggal,
				kategori = :kategori,
				keterangan = :keterangan,
				pemasukan = :pemasukan,
				pengeluaran = :pengeluaran,
				updated_at = :updated_at
		WHERE id = :id
		";

		$this->db->query($query);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('kategori', $data['kategori']);
		$this->db->bind('keterangan', $data['keterangan']);
		$this->db->bind('pemasukan', $data['arusKas'] == 'Pemasukan' ? $data['jumlah'] : NULL);
		$this->db->bind('pengeluaran', $data['arusKas'] == 'Pengeluaran' ? $data['jumlah'] : NULL);
		$this->db->bind('updated_at', date('Y-m-d H:i:s'));
		$this->db->bind('id', $data['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteKas($id) {
		$query = "DELETE FROM kas_kita WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);

		$this->db->execute();

		return $this->db->rowCount();
	}
	// end coding

	public function getPemasukanAll() {
		$this->db->query("SELECT SUM(`pemasukan`) AS total_pemasukan FROM kas_kita WHERE user_id = :userLogin");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}
	
	public function getPengeluaranAll() {
		$this->db->query("SELECT SUM(`pengeluaran`) AS total_pengeluaran FROM kas_kita WHERE user_id = :userLogin");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}

	public function getKasAll($params) {
		$this->db->query("SELECT * FROM kas_kita WHERE user_id = :userLogin AND tanggal BETWEEN :start_date AND :end_date ORDER BY tanggal DESC");

		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('start_date', $params['tglMulaiLaporan']);
		$this->db->bind('end_date', $params['tglSelesaiLaporan']);
		return $this->db->resultSet();
	}
}
