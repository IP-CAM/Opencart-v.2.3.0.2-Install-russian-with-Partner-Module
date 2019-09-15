<?php
class ModelModuleTaxes extends Model {
	public function addTaxes($data) {
		$this->db->query("INSERT INTO taxes_form SET forms = '" . $this->db->escape($data['forms']) . "', created_at = NOW(), updated_at = NOW()");
		
		$taxes_id = $this->db->getLastId();
		
		return $taxes_id;
	}

	
	public function getTotalTaxes() {
		$sql = "SELECT COUNT(*) AS total FROM taxes_form";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	

	
	public function getTaxes($data = array()) {
		$sql = "SELECT * FROM taxes_form ORDER BY taxes_id ASC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getTax($taxes_id) {
		$sql = "SELECT * FROM taxes_form WHERE taxes_id = '" . $taxes_id . "'";

		if (isset($sql)) {
			$query = $this->db->query($sql);

			return $query->row;
		}
	}
	
	public function deleteTaxes($taxes_id) {
		$this->db->query("DELETE FROM taxes_form WHERE taxes_id = '" . (int)$taxes_id . "'");	
	}
	
	public function editTaxes($taxes_id, $data) {
		$this->db->query("UPDATE taxes_form SET forms = '" . $data['forms'] ."' WHERE taxes_id = '" . (int)$taxes_id . "'");		
	}
	
	
	
}