<?php
class ControllerModuleTaxes extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('module/taxes');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('module/taxes');
		
		$this->getList();
	}
	
	public function add() {
		$this->load->language('module/taxes');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/taxes');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
			$this->model_module_taxes->addTaxes($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			//vare_dump($url);
			
			$this->response->redirect($this->url->link('module/taxes', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->load->language('module/taxes');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/taxes');
		

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_module_taxes->editTaxes($this->request->get['taxes_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/taxes', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}
	
	protected function getList() {

		$sort = 'name';
		$order = 'ASC';
		$page = 1;
		
		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/taxes', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('module/taxes/add', 'token=' . $this->session->data['token'] . $url, true);
		
		$data['delete'] = $this->url->link('module/taxes/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['taxes_s'] = array();

		$filter_data = array(
			'sort'                     => $sort,
			'order'                    => $order,
			'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                    => $this->config->get('config_limit_admin')
		);

		$taxes_total = $this->model_module_taxes->getTotalTaxes();

		$results = $this->model_module_taxes->getTaxes($filter_data);

		foreach ($results as $result) {
			$data['taxes_s'][] = array(
				'taxes_id'       => $result['taxes_id'],
				'forms'          => $result['forms'],
				'token'          => $this->session->data['token'],
				'edit'           => $this->url->link('module/taxes/edit', 'token=' . $this->session->data['token'] . '&taxes_id=' . $result['taxes_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_success'] = $this->language->get('text_success');
		$data['text_taxes'] = $this->language->get('text_taxes');
		$data['text_id'] = $this->language->get('text_id');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $taxes_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('module/taxes', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($taxes_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($taxes_total - $this->config->get('config_limit_admin'))) ? $taxes_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $taxes_total, ceil($taxes_total / $this->config->get('config_limit_admin')));


		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/taxes_list', $data));
	}
	
	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('module/taxes');

		$data['text_form'] = !isset($this->request->get['taxes_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_upload'] = $this->language->get('button_upload');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_success'] = $this->language->get('text_success');
		$data['text_taxes'] = $this->language->get('text_taxes');
		$data['text_id'] = $this->language->get('text_id');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['taxes_id'])) {
			$data['taxes_id'] = $this->request->get['taxes_id'];
			$data['taxes'] = $this->model_module_taxes->getTax($this->request->get['taxes_id']);
		} else {
			$data['taxes_id'] = 0;
			$data['taxes'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/taxes', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['taxes_id'])) {
			$data['action'] = $this->url->link('module/taxes/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('module/taxes/edit', 'token=' . $this->session->data['token'] . '&taxes_id=' . $this->request->get['taxes_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('module/taxes', 'token=' . $this->session->data['token'] . $url, true);

		$filter_data = array(
			'sort'  => 'cf.sort_order',
			'order' => 'ASC'
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/taxes_form', $data));
	}

	public function delete() {
		$this->load->language('module/taxes');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/taxes');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $taxes_id) {
				$this->model_module_taxes->deleteTaxes($taxes_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			

			$this->response->redirect($this->url->link('module/taxes', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'module/taxes')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	
	
}