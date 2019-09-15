<?php
class ModelModulePartner extends Model {
	public function addPartner($data, $filename) {
		if($filename){
			$this->db->query("INSERT INTO partner_offer SET first_name = '" . $this->db->escape($data['first_name']) . "', last_name = '" . $this->db->escape($data['last_name']) . "', email = '" . $this->db->escape($data['email']) . "', firm = '" . $this->db->escape($data['firm']) . "', taxes = '" . $this->db->escape($data['taxes']) . "', age = '" . (int)$data['age'] . "', comments = '" . $this->db->escape($data['comments']) . "', created_at = NOW(), updated_at = NOW(), document = '" . $filename . "'");
		}else{
			$this->db->query("INSERT INTO partner_offer SET first_name = '" . $this->db->escape($data['first_name']) . "', last_name = '" . $this->db->escape($data['last_name']) . "', email = '" . $this->db->escape($data['email']) . "', firm = '" . $this->db->escape($data['firm']) . "', taxes = '" . $this->db->escape($data['taxes']) . "', age = '" . (int)$data['age'] . "', comments = '" . $this->db->escape($data['comments']) . "', created_at = NOW(), updated_at = NOW()");
		}
		
		$partner_id = $this->db->getLastId();
		
		return $partner_id;
	}
	
	//document = '" . $this->db->escape($data['document']) . "', 
	

	
	
	
	
}