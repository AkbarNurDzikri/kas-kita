<?php

class Kas_kita_model
{
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	// ajax pengeluaran datatables
	public function getPengeluaranAjax() {
		$this->db->query("SELECT COUNT(`id`) AS data_rows FROM kas_kita WHERE pemasukan IS NULL");
		return $this->db->resultSet();
	}

	public function setPengeluaranOutput($order, $dir, $limit, $start) {
		$this->db->query("SELECT * FROM kas_kita WHERE pemasukan IS NULL ORDER BY $order $dir LIMIT $limit OFFSET $start");
		return $this->db->resultSet();
	}

	public function getPengeluaranSearch($order, $dir, $limit, $start, $keyword) {
		$this->db->query("SELECT * FROM kas_kita WHERE pemasukan IS NULL AND kategori LIKE :keyword OR keterangan LIKE :keyword ORDER BY $order $dir LIMIT $limit OFFSET $start");

		$this->db->bind('keyword', "%$keyword%");
		return $this->db->resultSet();
	}

	public function getPengeluaranSearchLength($keyword) {
		$this->db->query("SELECT COUNT(`id`) AS data_rows FROM kas_kita WHERE pemasukan IS NULL AND kategori LIKE :keyword OR keterangan LIKE :keyword");

		$this->db->bind('keyword', "%$keyword%");
		return $this->db->resultSet();
	}
	// ajax pengeluaran datatables

	// ajax pemasukan datatables
	public function getPemasukanAjax() {
		$this->db->query("SELECT COUNT(`id`) AS data_rows FROM kas_kita WHERE pengeluaran IS NULL");
		return $this->db->resultSet();
	}

	public function setPemasukanOutput($order, $dir, $limit, $start) {
		$this->db->query("SELECT * FROM kas_kita WHERE pengeluaran IS NULL ORDER BY $order $dir LIMIT $limit OFFSET $start");
		return $this->db->resultSet();
	}

	public function getPemasukanSearch($order, $dir, $limit, $start, $keyword) {
		$this->db->query("SELECT * FROM kas_kita WHERE pengeluaran IS NULL AND kategori LIKE :keyword OR keterangan LIKE :keyword ORDER BY $order $dir LIMIT $limit OFFSET $start");

		$this->db->bind('keyword', "%$keyword%");
		return $this->db->resultSet();
	}

	public function getPemasukanSearchLength($keyword) {
		$this->db->query("SELECT COUNT(`id`) AS data_rows FROM kas_kita WHERE pengeluaran IS NULL AND kategori LIKE :keyword OR keterangan LIKE :keyword");

		$this->db->bind('keyword', "%$keyword%");
		return $this->db->resultSet();
	}
	// ajax pemasukan datatables

	public function createKas($data) {
		$query = "INSERT INTO kas_kita VALUES (NULL, :tanggal, :kategori, :keterangan, :pemasukan, :pengeluaran, :created_at, :updated_at)";

		$this->db->query($query);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('kategori', $data['kategori']);
		$this->db->bind('keterangan', $data['keterangan']);
		$this->db->bind('pemasukan', $data['arusKas'] == 'Kas Masuk' ? $data['jumlah'] : NULL);
		$this->db->bind('pengeluaran', $data['arusKas'] == 'Kas Keluar' ? $data['jumlah'] : NULL);
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
		$this->db->bind('pemasukan', $data['arusKas'] == 'Kas Masuk' ? $data['jumlah'] : NULL);
		$this->db->bind('pengeluaran', $data['arusKas'] == 'Kas Keluar' ? $data['jumlah'] : NULL);
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
		$this->db->query("SELECT SUM(`pemasukan`) AS total_pemasukan FROM kas_kita");
		return $this->db->resultSet();
	}
	
	public function getPengeluaranAll() {
		$this->db->query("SELECT SUM(`pengeluaran`) AS total_pengeluaran FROM kas_kita");
		return $this->db->resultSet();
	}

	public function getKasAll($params) {
		$this->db->query("SELECT * FROM kas_kita WHERE tanggal BETWEEN :start_date AND :end_date ORDER BY tanggal DESC");
		$this->db->bind('start_date', $params['tglMulaiLaporan']);
		$this->db->bind('end_date', $params['tglSelesaiLaporan']);
		return $this->db->resultSet();
	}
}
