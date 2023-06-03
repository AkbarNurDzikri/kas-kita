<?php

class Kas_kita_model
{
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	// ajax pengeluaran datatables
	public function getPengeluaranAjax() {
		$this->db->query("SELECT COUNT(kas_kita.id) AS data_rows FROM kas_kita INNER JOIN users ON users.id = kas_kita.user_id WHERE pemasukan IS NULL AND kas_kita.user_id = :userLogin");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}

	public function setPengeluaranOutput($order, $dir, $limit, $start) {
		$this->db->query("SELECT k.*, u.username FROM kas_kita AS k INNER JOIN users AS u ON u.id = k.user_id WHERE pemasukan IS NULL AND k.user_id = :userLogin ORDER BY $order $dir LIMIT $limit OFFSET $start");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}

	public function getPengeluaranSearch($order, $dir, $limit, $start, $keyword) {
		$this->db->query("SELECT k.* FROM kas_kita AS k INNER JOIN users AS u ON u.id = k.user_id WHERE k.user_id = :userLogin AND pemasukan IS NULL AND keterangan LIKE :keyword ORDER BY $order $dir LIMIT $limit OFFSET $start");

		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('keyword',"%$keyword%");
		return $this->db->resultSet();
	}

	public function getPengeluaranSearchLength($keyword) {
		$this->db->query("SELECT COUNT(kas_kita.id) AS data_rows FROM kas_kita INNER JOIN users ON users.id = kas_kita.user_id WHERE kas_kita.user_id = :userLogin AND pemasukan IS NULL AND keterangan LIKE :keyword");

		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('keyword',"%$keyword%");
		return $this->db->resultSet();
	}
	// ajax pengeluaran datatables

	// ajax pemasukan datatables
	public function getPemasukanAjax() {
		$this->db->query("SELECT COUNT(kas_kita.id) AS data_rows FROM kas_kita INNER JOIN users ON users.id = kas_kita.user_id WHERE pengeluaran IS NULL AND kas_kita.user_id = :userLogin");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}

	public function setPemasukanOutput($order, $dir, $limit, $start) {
		$this->db->query("SELECT k.* FROM kas_kita AS k INNER JOIN users AS u ON u.id = k.user_id WHERE pengeluaran IS NULL AND k.user_id = :userLogin ORDER BY $order $dir LIMIT $limit OFFSET $start");
		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		return $this->db->resultSet();
	}

	public function getPemasukanSearch($order, $dir, $limit, $start, $keyword) {
		$this->db->query("SELECT k.* FROM kas_kita AS k INNER JOIN users AS u ON u.id = k.user_id WHERE k.user_id = :userLogin AND pengeluaran IS NULL AND keterangan LIKE :keyword ORDER BY $order $dir LIMIT $limit OFFSET $start");

		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('keyword', "%$keyword%");
		return $this->db->resultSet();
	}

	public function getPemasukanSearchLength($keyword) {
		$this->db->query("SELECT COUNT(kas_kita.id) AS data_rows FROM kas_kita INNER JOIN users ON users.id = kas_kita.user_id WHERE kas_kita.user_id = :userLogin AND pengeluaran IS NULL AND keterangan LIKE :keyword");

		$this->db->bind('userLogin', $_SESSION['userInfo']['id']);
		$this->db->bind('keyword', "%$keyword%");
		return $this->db->resultSet();
	}
	// ajax pemasukan datatables

	public function createKas($data) {
		$query = "INSERT INTO kas_kita VALUES (NULL, :user_id, :tanggal, :kategori, :keterangan, :pemasukan, :pengeluaran, :created_at, :updated_at)";

		$this->db->query($query);
		$this->db->bind('user_id', $_SESSION['userInfo']['id']);
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
