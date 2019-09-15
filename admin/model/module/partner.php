<?php
class ModelModulePartner extends Model {
	public function addPartner($data) {
		$this->db->query("INSERT INTO partner_offer SET first_name = '" . $this->db->escape($data['first_name']) . "', last_name = '" . $this->db->escape($data['last_name']) . "', email = '" . $this->db->escape($data['email']) . "', firm = '" . $this->db->escape($data['firm']) . "', taxes = '" . $this->db->escape($data['taxes']) . "', age = '" . (int)$data['age'] . "', comments = '" . $this->db->escape($data['comments']) . "', created_at = NOW(), updated_at = NOW()");
		
		$partner_id = $this->db->getLastId();
		
		return $partner_id;
	}
	
	//document = '" . $this->db->escape($data['document']) . "', 
	

	public function getTotalPartners($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM partner_offer";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "first_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_last_name'])) {
			$implode[] = "last_name LIKE '%" . $this->db->escape($data['filter_last_name']) . "%'";
		}

		if (isset($data['filter_firm']) ) {
			$implode[] = "firm LIKE '%" . $this->db->escape($data['filter_firm']) . "%'";
		}

		if (isset($data['filter_status']) ) {
			$implode[] = "status LIKE '%" . $this->db->escape($data['filter_status']) . "%'";
		}

		if (isset($data['filter_taxes']) ) {
			$implode[] = "taxes LIKE '%" . $this->db->escape($data['filter_taxes']) . "%'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getPartner($partner_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM partner_offer WHERE partner_id = '" . (int)$partner_id . "'");

		return $query->row;
	}
	
	public function getPartners($data = array()) {
		$sql = "SELECT * FROM partner_offer WHERE partner_id > 0 ";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "first_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_last_name'])) {
			$implode[] = "last_name LIKE '%" . $this->db->escape($data['filter_last_name']) . "%'";
		}

		if (isset($data['filter_firm']) ) {
			$implode[] = "firm = '" . $this->db->escape($data['filter_firm']) . "'";
		}

		if (isset($data['filter_status']) ) {
			$implode[] = "status = '" . $this->db->escape($data['filter_status']) . "'";
		}

		if (isset($data['filter_taxes']) ) {
			$implode[] = "taxes = '" . $this->db->escape($data['filter_taxes']) . "'";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'first_name',
			'last_name',
			'firm',
			'status',
			'taxes'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY first_name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

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
	
	public function deletePartner($partner_id) {
		$this->db->query("DELETE FROM partner_offer WHERE partner_id = '" . (int)$partner_id . "'");		
	}
	
	public function editPartner($partner_id) {
		$this->db->query("UPDATE partner_offer SET status = 1 WHERE partner_id = '" . (int)$partner_id . "'");		
	}
	
	
	
}