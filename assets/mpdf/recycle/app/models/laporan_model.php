<?php

class Laporan_model
{
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	// laporan ajax
	public function getAll() {
		$this->db->query("SELECT COUNT(r.id) AS data_rows, crtr.fullname AS creator, updtr.fullname AS updater FROM reports AS r INNER JOIN users AS crtr ON crtr.id = r.created_by LEFT JOIN users AS updtr ON updtr.id = r.updated_by");
		return $this->db->resultSet();
	}

	public function setOutput($order, $dir, $limit, $start) {
		$this->db->query("SELECT r.*, crtr.fullname AS creator, updtr.fullname AS updater FROM reports AS r INNER JOIN users AS crtr ON crtr.id = r.created_by LEFT JOIN users AS updtr ON updtr.id = r.updated_by ORDER BY $order $dir LIMIT $limit OFFSET $start");
		return $this->db->resultSet();
	}

	public function getResultSearch($order, $dir, $limit, $start, $keyword) {
		$this->db->query("SELECT r.*, crtr.fullname AS creator, updtr.fullname AS updater FROM reports AS r INNER JOIN users AS crtr ON crtr.id = r.created_by LEFT JOIN users AS updtr ON updtr.id = r.updated_by WHERE r.operator1 LIKE :keyword ORDER BY $order $dir LIMIT $limit OFFSET $start");

		$this->db->bind('keyword',"%$keyword%");
		return $this->db->resultSet();
	}

	public function getResultSearchLength($keyword) {
		$this->db->query("SELECT COUNT(r.id) AS data_rows, crtr.fullname AS creator, updtr.fullname AS updater FROM reports AS r INNER JOIN users AS crtr ON crtr.id = r.created_by LEFT JOIN users AS updtr ON updtr.id = r.updated_by WHERE r.operator1 LIKE :keyword");

		$this->db->bind('keyword',"%$keyword%");
		return $this->db->resultSet();
	}
	// laporan ajax

	// create laporan
	public function createReport($data) {
		$query = "INSERT INTO reports VALUES (NULL, :tanggal, :shift, :operator1, :operator2, :temp_extru1, :temp_filterzone1, :temp_die1, :temp_extru2, :temp_filterzone2, :temp_die2, :temp_extru3, :temp_extru4, :rpm_rollfeeder, :rpm_screw, :rpm_pelletizer, :machine, :output, :waste_awal, :created_by, :updated_by, :created_at, :updated_at)";

		$this->db->query($query);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('shift', $data['shift']);
		$this->db->bind('operator1', $data['operator1']);
		$this->db->bind('operator2', $data['operator2']);
		$this->db->bind('temp_extru1', $data['temp_extru1']);
		$this->db->bind('temp_filterzone1', $data['temp_filterzone1']);
		$this->db->bind('temp_die1', $data['temp_die1']);
		$this->db->bind('temp_extru2', $data['temp_extru2']);
		$this->db->bind('temp_filterzone2', $data['temp_filterzone2']);
		$this->db->bind('temp_die2', $data['temp_die2']);
		$this->db->bind('temp_extru3', $data['temp_extru3'] = "" ? $data['temp_extru3'] : NULL);
		$this->db->bind('temp_extru4', $data['temp_extru4'] = "" ? $data['temp_extru4'] : NULL);
		$this->db->bind('rpm_rollfeeder', $data['rpm_rollfeeder']);
		$this->db->bind('rpm_screw', $data['rpm_screw']);
		$this->db->bind('rpm_pelletizer', $data['rpm_pelletizer']);
		$this->db->bind('machine', $data['machine']);
		$this->db->bind('output', $data['output']);
		$this->db->bind('waste_awal', $data['waste_awal']);
		$this->db->bind('created_by', $_SESSION['userInfo']['id']);
		$this->db->bind('updated_by', NULL);
		$this->db->bind('created_at', date('Y-m-d H:i:s'));
		$this->db->bind('updated_at', NULL);

		$this->db->execute();

		return $this->db->rowCount();
	}
	// create laporan

	// update laporan
	public function updateLaporan($data) {
		$query = "UPDATE reports SET
			tanggal = :tanggal,
			shift = :shift,
			operator1 = :operator1,
			operator2 = :operator2,
			temp_extru1 = :temp_extru1,
			temp_filterzone1 = :temp_filterzone1,
			temp_die1 = :temp_die1,
			temp_extru2 = :temp_extru2,
			temp_filterzone2 = :temp_filterzone2,
			temp_die2 = :temp_die2,
			temp_extru3 = :temp_extru3,
			temp_extru4 = :temp_extru4,
			rpm_rollfeeder = :rpm_rollfeeder,
			rpm_screw = :rpm_screw,
			rpm_pelletizer = :rpm_pelletizer,
			machine = :machine,
			output = :output,
			waste_awal = :waste_awal,
			updated_by = :updated_by,
			updated_at = :updated_at
		WHERE id = :id
		";

		$this->db->query($query);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('shift', $data['shift']);
		$this->db->bind('operator1', $data['operator1']);
		$this->db->bind('operator2', $data['operator2']);
		$this->db->bind('temp_extru1', $data['temp_extru1']);
		$this->db->bind('temp_filterzone1', $data['temp_filterzone1']);
		$this->db->bind('temp_die1', $data['temp_die1']);
		$this->db->bind('temp_extru2', $data['temp_extru2']);
		$this->db->bind('temp_filterzone2', $data['temp_filterzone2']);
		$this->db->bind('temp_die2', $data['temp_die2']);
		$this->db->bind('temp_extru3', $data['temp_extru3'] == "" ? NULL : $data['temp_extru3']);
		$this->db->bind('temp_extru4', $data['temp_extru4'] == "" ? NULL : $data['temp_extru4']);
		$this->db->bind('rpm_rollfeeder', $data['rpm_rollfeeder']);
		$this->db->bind('rpm_screw', $data['rpm_screw']);
		$this->db->bind('rpm_pelletizer', $data['rpm_pelletizer']);
		$this->db->bind('machine', $data['machine']);
		$this->db->bind('output', $data['output']);
		$this->db->bind('waste_awal', $data['waste_awal']);
		$this->db->bind('updated_by', $_SESSION['userInfo']['id']);
		$this->db->bind('updated_at', date('Y-m-d H:i:s'));
		$this->db->bind('id', $data['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	// update laporan

	// delete laporan
	public function deleteLaporan($id) {
		$query = "DELETE FROM reports WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);

		$this->db->execute();

		return $this->db->rowCount();
	}
	// delete laporan

	// get report by id
	public function getReportById($id) {
		$this->db->query("SELECT * FROM reports WHERE id = :id");
		$this->db->bind('id', $id);
		return $this->db->resultSet();
	}
	// get report by id

	// --------------------- details laporan ---------------------------

	// report details ajax
	public function getReportDetails($id) {
		$this->db->query("SELECT COUNT(rd.id) AS data_rows, crtr.fullname AS creator, updtr.fullname AS updater FROM report_details AS rd INNER JOIN users AS crtr ON rd.created_by = crtr.id LEFT JOIN users AS updtr ON rd.updated_by = updtr.id WHERE report_id = :id");
		$this->db->bind('id', $id);
		return $this->db->resultSet();
	}

	public function setOutputDetails($order, $dir, $limit, $start, $reportId) {
		$this->db->query("SELECT rd.*, crtr.fullname AS creator, updtr.fullname AS updater FROM report_details AS rd INNER JOIN users AS crtr ON rd.created_by = crtr.id LEFT JOIN users AS updtr ON rd.updated_by = updtr.id WHERE report_id = :reportId ORDER BY $order $dir LIMIT $limit OFFSET $start");
		$this->db->bind('reportId', $reportId);
		return $this->db->resultSet();
	}

	public function getResultDetailsSearch($order, $dir, $limit, $start, $keyword, $reportId) {
		$this->db->query("SELECT rd.*, crtr.fullname AS creator, updtr.fullname AS updater FROM report_details AS rd INNER JOIN users AS crtr ON rd.created_by = crtr.id LEFT JOIN users AS updtr ON rd.updated_by = updtr.id WHERE report_id = :id AND product_type LIKE :keyword ORDER BY $order $dir LIMIT $limit OFFSET $start");

		$this->db->bind('id', $reportId);
		$this->db->bind('keyword',"%$keyword%");
		return $this->db->resultSet();
	}

	public function getResultDetailsSearchLength($keyword, $reportId) {
		$this->db->query("SELECT COUNT(rd.id) AS data_rows, crtr.fullname AS creator, updtr.fullname AS updater FROM report_details AS rd INNER JOIN users AS crtr ON rd.created_by = crtr.id LEFT JOIN users AS updtr ON rd.updated_by = updtr.id WHERE report_id = :id AND product_type LIKE :keyword");

		$this->db->bind('id', $reportId);
		$this->db->bind('keyword',"%$keyword%");
		return $this->db->resultSet();
	}
	// report details ajax

	// create details laporan
	public function createReportDetails($data) {
		$query = "INSERT INTO report_details VALUES (NULL, :report_id, :time_start, :time_finish, :bm1_material_specs, :bm1_material_qty, :bm2_material_specs, :bm2_material_qty, :other_material_specs, :other_material_type, :other_material_category, :other_material_qty, :product_type, :product_qty, :waste_type, :waste_qty, :remarks, :created_by, :updated_by, :created_at, :updated_at)";

		$this->db->query($query);
		$this->db->bind('report_id', $data['report_id']);
		$this->db->bind('time_start', $data['time_start']);
		$this->db->bind('time_finish', $data['time_finish']);
		$this->db->bind('bm1_material_specs', $data['bm1_material_specs'] == NULL ? NULL : $data['bm1_material_specs']);
		$this->db->bind('bm1_material_qty', $data['bm1_material_qty'] == NULL ? NULL : $data['bm1_material_qty']);
		$this->db->bind('bm2_material_specs', $data['bm2_material_specs'] == NULL ? NULL : $data['bm2_material_specs']);
		$this->db->bind('bm2_material_qty', $data['bm2_material_qty'] == NULL ? NULL : $data['bm2_material_qty']);
		$this->db->bind('other_material_specs', $data['other_material_specs'] == NULL ? NULL : $data['other_material_specs']);
		$this->db->bind('other_material_type', $data['other_material_type'] == NULL ? NULL : $data['other_material_type']);
		$this->db->bind('other_material_category', $data['other_material_category'] == NULL ? NULL : $data['other_material_category']);
		$this->db->bind('other_material_qty', $data['other_material_qty'] == NULL ? NULL : $data['other_material_qty']);
		$this->db->bind('product_type', $data['product_type']);
		$this->db->bind('product_qty', $data['product_qty']);
		$this->db->bind('waste_type', $data['waste_type'] == NULL ? NULL : $data['waste_type']);
		$this->db->bind('waste_qty', $data['waste_qty'] == NULL ? NULL : $data['waste_qty']);
		$this->db->bind('remarks', $data['remarks'] == NULL ? NULL : $data['remarks']);
		$this->db->bind('created_by', $_SESSION['userInfo']['id']);
		$this->db->bind('updated_by', NULL);
		$this->db->bind('created_at', date('Y-m-d H:i:s'));
		$this->db->bind('updated_at', NULL);

		$this->db->execute();

		return $this->db->rowCount();
	}
	// create details laporan

	// update details laporan
	public function updateDetailsLaporan($data) {
		$query = "UPDATE report_details SET
			time_start = :time_start,
			time_finish = :time_finish,
			bm1_material_specs = :bm1_material_specs,
			bm1_material_qty = :bm1_material_qty,
			bm2_material_specs = :bm2_material_specs,
			bm2_material_qty = :bm2_material_qty,
			other_material_specs = :other_material_specs,
			other_material_type = :other_material_type,
			other_material_category = :other_material_category,
			other_material_qty = :other_material_qty,
			product_type = :product_type,
			product_qty = :product_qty,
			waste_type = :waste_type,
			waste_qty = :waste_qty,
			remarks = :remarks,
			updated_by = :updated_by,
			updated_at = :updated_at
		WHERE id = :id
		";

		$this->db->query($query);
		$this->db->bind('time_start', $data['time_start']);
		$this->db->bind('time_finish', $data['time_finish']);
		$this->db->bind('bm1_material_specs', $data['bm1_material_specs'] == NULL ? NULL : $data['bm1_material_specs']);
		$this->db->bind('bm1_material_qty', $data['bm1_material_qty'] == NULL ? NULL : $data['bm1_material_qty']);
		$this->db->bind('bm2_material_specs', $data['bm2_material_specs'] == NULL ? NULL : $data['bm2_material_specs']);
		$this->db->bind('bm2_material_qty', $data['bm2_material_qty'] == NULL ? NULL : $data['bm2_material_qty']);
		$this->db->bind('other_material_specs', $data['other_material_specs'] == NULL ? NULL : $data['other_material_specs']);
		$this->db->bind('other_material_type', $data['other_material_type'] == NULL ? NULL : $data['other_material_type']);
		$this->db->bind('other_material_category', $data['other_material_category'] == NULL ? NULL : $data['other_material_category']);
		$this->db->bind('other_material_qty', $data['other_material_qty'] == NULL ? NULL : $data['other_material_qty']);
		$this->db->bind('product_type', $data['product_type']);
		$this->db->bind('product_qty', $data['product_qty']);
		$this->db->bind('waste_type', $data['waste_type'] == NULL ? NULL : $data['waste_type']);
		$this->db->bind('waste_qty', $data['waste_qty'] == NULL ? NULL : $data['waste_qty']);
		$this->db->bind('remarks', $data['remarks'] == NULL ? NULL : $data['remarks']);
		$this->db->bind('updated_by', $_SESSION['userInfo']['id']);
		$this->db->bind('updated_at', date('Y-m-d H:i:s'));
		$this->db->bind('id', $data['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	// update details laporan

	// delete details laporan
	public function deleteDetailsLaporan($id) {
		$query = "DELETE FROM report_details WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);

		$this->db->execute();

		return $this->db->rowCount();
	}
	// delete details laporan

	// get report details
	public function getPrint($id) {
		$this->db->query("SELECT * FROM report_details WHERE report_id = :id");
		$this->db->bind('id', $id);
		return $this->db->resultSet();
	}
	// get report details

	// get report details
	public function getPrintX($data) {
		$this->db->query("SELECT r.tanggal,
			r.shift,
			r.operator1,
			r.operator2,
			SUM(CASE WHEN rd.other_material_category = 'Clear' THEN rd.other_material_qty ELSE 0 END) AS `rm_clear`,
			SUM(CASE WHEN rd.other_material_category = 'White' THEN rd.other_material_qty ELSE 0 END) AS `rm_white`,
			SUM(CASE WHEN rd.other_material_category = 'Zak Resin' THEN rd.other_material_qty ELSE 0 END) AS `rm_zak_resin`,
			SUM(CASE WHEN rd.other_material_category = 'Reject' THEN rd.other_material_qty ELSE 0 END) AS `rm_reject`,
			SUM(CASE WHEN rd.product_type = 'Clear' THEN rd.product_qty ELSE 0 END) AS `fg_clear`,
			SUM(CASE WHEN rd.product_type = 'White' THEN rd.product_qty ELSE 0 END) AS `fg_white`,
			SUM(CASE WHEN rd.product_type = 'Noblen' THEN rd.product_qty ELSE 0 END) AS `fg_noblen`,
			SUM(CASE WHEN rd.product_type = 'Purging' THEN rd.product_qty ELSE 0 END) AS `fg_purging`,
			SUM(CASE WHEN rd.waste_type = 'Powder' THEN rd.waste_qty ELSE 0 END) AS `waste_powder`,
			SUM(CASE WHEN rd.waste_type = 'Frozen' THEN rd.waste_qty ELSE 0 END) AS `waste_frozen`,
			GROUP_CONCAT(rd.remarks SEPARATOR ' | ') AS remarks
			FROM report_details AS rd INNER JOIN reports AS r ON r.id = rd.report_id
			WHERE r.tanggal BETWEEN :start AND :finish
			GROUP BY r.tanggal, r.shift
		");

		$this->db->bind('start', $data['start'] . ' 0:00:00');
		$this->db->bind('finish', $data['finish'] . ' 23:59:59');
		return $this->db->resultSet();
	}
	// get report details

	// get report details by id
	public function getReportDetailsById($id) {
		$this->db->query("SELECT rd.*, r.machine FROM report_details AS rd INNER JOIN reports AS r ON r.id = rd.report_id WHERE rd.id = :id");
		$this->db->bind('id', $id);
		return $this->db->single();
	}
	// get report details by id

	// get last ID
	public function getLastId() {
		$this->db->query("SELECT LAST_INSERT_ID() AS lastId FROM reports");

		return $this->db->single();
	}
	// get last ID
}
