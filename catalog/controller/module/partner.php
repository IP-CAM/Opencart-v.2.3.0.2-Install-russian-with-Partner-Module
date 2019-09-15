<?php
class ControllerModulePartner extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('module/partner');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		
		$this->load->model('module/partner');
		
		
		
		//П®пїЅлҐ пїЅаІЁпїЅ к­®пЄЁ
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!empty($this->request->files['document']['name'])){
				$filename = $this->transform($this->request->files['document']['name']);
				move_uploaded_file($this->request->files['document']['tmp_name'], DIR_DOWNLOAD . $filename);
			}
			
			$partner_id = $this->model_module_partner->addPartner($this->request->post, $filename);
			
			

			$this->response->redirect($this->url->link('module/partner/success'));
		}
		
		
		
		
		
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/partner')
		);
		
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_partner'] = $this->language->get('text_partner');
		$data['text_taxes'] = $this->language->get('text_taxes');
		$data['text_success'] = $this->language->get('text_success');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_last_name'] = $this->language->get('entry_last_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_firm'] = $this->language->get('entry_firm');
		$data['entry_taxes'] = $this->language->get('entry_taxes');
		$data['entry_age'] = $this->language->get('entry_age');
		$data['entry_document'] = $this->language->get('entry_document');
		$data['entry_comments'] = $this->language->get('entry_comments');
		$data['partner_desc0'] = $this->language->get('partner_desc0');
		$data['partner_desc1'] = $this->language->get('partner_desc1');
		$data['partner_desc2'] = $this->language->get('partner_desc2');
		$data['partner_desc3'] = $this->language->get('partner_desc3');
		$data['partner_desc4'] = $this->language->get('partner_desc4');
		$data['partner_desc5'] = $this->language->get('partner_desc5');
		$data['partner_desc6'] = $this->language->get('partner_desc6');
		$data['partner_desc7'] = $this->language->get('partner_desc7');
		$data['partner_desc8'] = $this->language->get('partner_desc8');
		$data['partner_desc9'] = $this->language->get('partner_desc9');
		
		if (isset($this->error['first_name'])) {
			$data['error_name'] = $this->error['first_name'];
		} else {
			$data['error_name'] = '';
		}
		if (isset($this->error['last_name'])) {
			$data['error_last_name'] = $this->error['last_name'];
		} else {
			$data['error_last_name'] = '';
		}
		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}
		if (isset($this->error['comments'])) {
			$data['error_enquiry'] = $this->error['comments'];
		} else {
			$data['error_enquiry'] = '';
		}
		if (isset($this->error['document'])) {
			$data['error_file'] = $this->error['document'];
		} else {
			$data['error_file'] = '';
		}

		
		
		
		
		
		
		
		$data['button_submit'] = $this->language->get('button_submit');
		

		$data['action'] = $this->url->link('module/partner', '', true);
		
		
		if (isset($this->request->post['first_name'])) {
			$data['first_name'] = $this->request->post['first_name'];
		} else {
			$data['first_name'] = '';
		}
		
		if (isset($this->request->post['last_name'])) {
			$data['last_name'] = $this->request->post['last_name'];
		} else {
			$data['last_name'] = '';
		}
		
		if (isset($this->request->post['firm'])) {
			$data['firm'] = $this->request->post['firm'];
		} else {
			$data['firm'] = '';
		}
		
		if (isset($this->request->post['taxes'])) {
			$data['taxes'] = $this->request->post['taxes'];
		} else {
			$data['taxes'] = '';
		}
		
		if (isset($this->request->post['document'])) {
			$data['document'] = $this->request->post['document'];
		} else {
			$data['document'] = '';
		}
		
		if (isset($this->request->post['age'])) {
			$data['age'] = $this->request->post['age'];
		} else {
			$data['age'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
				
		if (isset($this->request->post['comments'])) {
			$data['comments'] = $this->request->post['comments'];
		} else {
			$data['comments'] = '';
		}
		
		$this->load->model('module/taxes');

		$data['taxes_forms'] = $this->model_module_taxes->getTaxes();

		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		


		$this->response->setOutput($this->load->view('module/partner_form', $data));
	}
	
	
	
	protected function validate() {
		if ((utf8_strlen($this->request->post['first_name']) < 3) || (utf8_strlen($this->request->post['first_name']) > 32)) {
			$this->error['first_name'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['last_name']) < 3) || (utf8_strlen($this->request->post['last_name']) > 32)) {
			$this->error['last_name'] = $this->language->get('error_last_name');
		}

		if (!filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['comments']) > 3000)) {
			$this->error['comments'] = $this->language->get('error_enquiry');
		}

		$allowed =  array('pdf','xlsx');
		$filename = $_FILES['document']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed) && $filename) {
    		$this->error['document'] = $this->language->get('error_file');;
		}

		return !$this->error;
	}
	
	public function success() {
		$this->load->language('module/partner');;

		$this->document->setTitle($this->language->get('heading_title_s'));
		
		$data1['text_success'] = $this->language->get('text_success');
		
		$data1['breadcrumbs'] = array();
		$data1['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data1['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_s'),
			'href' => $this->url->link('module/success')
		);

		$data1['heading_title_s'] = $this->language->get('heading_title_s');

		$data1['column_left'] = $this->load->controller('common/column_left');
		$data1['column_right'] = $this->load->controller('common/column_right');
		$data1['content_top'] = $this->load->controller('common/content_top');
		$data1['content_bottom'] = $this->load->controller('common/content_bottom');
		$data1['footer'] = $this->load->controller('common/footer');
		$data1['header'] = $this->load->controller('common/header');
		
		
		
		
		$this->response->setOutput($this->load->view('module/success', $data1));
	}
	
	public function transform($string){
		$arr = array( 'А' => 'A' , 'Б' => 'B' , 'В' => 'V' , 'Г' => 'G', 'Д' => 'D' , 'Е' => 'E' , 'Ё' => 'JO' , 'Ж' => 'ZH', 'З' => 'Z' , 'И' => 'I' , 'Й' => 'JJ' , 'К' => 'K', 'Л' => 'L' , 'М' => 'M' , 'Н' => 'N' , 'О' => 'O', 'П' => 'P' , 'Р' => 'R' , 'С' => 'S' , 'Т' => 'T', 'У' => 'U' , 'Ф' => 'F' , 'Х' => 'KH' , 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '"', 'Ы' => 'Y' , 'Ь' => '', 'Э' => 'EH' , 'Ю' => 'JU', 'Я' => 'JA', 'а' => 'a' , 'б' => 'b' , 'в' => 'v' , 'г' => 'g', 'д' => 'd', 'е' => 'e' , 'ё' => 'jo' , 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'jj', 'к' => 'k' , 'л' => 'l' , 'м' => 'm', 'н' => 'n', 'о' => 'o' , 'п' => 'p' , 'р' => 'r' , 'с' => 's', 'т' => 't', 'у' => 'u' , 'ф' => 'f' , 'х' => 'kh', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '"' , 'ы' => 'y', 'ь' => '_', 'э' => 'eh', 'ю' => 'ju' , 'я' => 'ja', ' ' => '_');
		$key = array_keys($arr);
		$val = array_values($arr);
		$translate = str_replace($key, $val, $string);
		return $translate;
	}
	
	
}