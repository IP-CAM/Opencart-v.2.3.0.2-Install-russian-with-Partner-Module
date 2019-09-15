<?php
class ControllerModuleSuccess extends Controller{
	
	public function index(){
		$this->load->language('module/success');
		
		
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
		$data1['footer'] = $this->load->controller('common/footer');
		$data1['header'] = $this->load->controller('common/header');
		
	
		
		
		
		$this->response->setOutput($this->load->view('module/success', $data1));
	}
	
	
	
}