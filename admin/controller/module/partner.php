<?php
class ControllerModulePartner extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('module/partner');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('module/partner');
		
		$this->getList();

		//$this->response->setOutput($this->load->view('module/partner_form', $data));
	}
	
	public function edit() {
		$this->load->language('module/partner');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/partner');
		

		if (isset($this->request->get['partner_id'])) {
			//$this->model_module_partner->editPartner($this->request->get['partner_id'], $this->request->post);
			$this->model_module_partner->editPartner($this->request->get['partner_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_last_name'])) {
				$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_firm'])) {
				$url .= '&filter_firm=' . $this->request->get['filter_firm'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_taxes'])) {
				$url .= '&filter_taxes=' . $this->request->get['filter_taxes'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			

			$this->response->redirect($this->url->link('module/partner', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}
	

	
	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->get['filter_last_name'])) {
			$filter_last_name = $this->request->get['filter_last_name'];
		} else {
			$filter_last_name = null;
		}

		if (isset($this->request->get['filter_firm'])) {
			$filter_firm = $this->request->get['filter_firm'];
		} else {
			$filter_firm = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_taxes'])) {
			$filter_taxes = $this->request->get['filter_taxes'];
		} else {
			$filter_taxes = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_last_name'])) {
			$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_firm'])) {
			$url .= '&filter_firm=' . $this->request->get['filter_firm'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_taxes'])) {
			$url .= '&filter_taxes=' . $this->request->get['filter_taxes'];
		}

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
			'href' => $this->url->link('module/partner', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('module/partner/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('module/partner/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['partners'] = array();

		$filter_data = array(
			'filter_name'              => $filter_name,
			'filter_last_name'         => $filter_last_name,
			'filter_firm' 			   => $filter_firm,
			'filter_status'            => $filter_status,
			'filter_taxes'             => $filter_taxes,
			'sort'                     => $sort,
			'order'                    => $order,
			'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                    => $this->config->get('config_limit_admin')
		);

		$partner_total = $this->model_module_partner->getTotalPartners($filter_data);

		$results = $this->model_module_partner->getPartners($filter_data);

		foreach ($results as $result) {
			$data['partners'][] = array(
				'partner_id'     => $result['partner_id'],
				'name'           => $result['first_name'],
				'last_name'      => $result['last_name'],
				'email'          => $result['email'],
				'firm'           => $result['firm'],
				'status'         => ($result['status'] == 1 ? 'Рассмотрено' : 'Не рассмотрено'),
				'taxes'          => $result['taxes'],
				'age'            => $result['age'],
				'document'       => $result['document'],
				'comments'       => $result['comments'],
				'token'          => $this->session->data['token'],
				'edit'           => $this->url->link('module/partner/edit', 'token=' . $this->session->data['token'] . '&partner_id=' . $result['partner_id'] . $url, true)
			);
		}

//$this->url->link('module/partner', 'token=' . $this->session->data['token'] . $url, true)

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_success'] = $this->language->get('text_success');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_last_name'] = $this->language->get('column_last_name');
		$data['column_email'] = $this->language->get('column_email');
		$data['column_firm'] = $this->language->get('column_firm');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_age'] = $this->language->get('column_age');
		$data['column_comment'] = $this->language->get('column_comment');
		$data['column_taxes'] = $this->language->get('column_taxes');
		$data['column_document'] = $this->language->get('column_document');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_last_name'] = $this->language->get('entry_last_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_firm'] = $this->language->get('entry_firm');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_taxes'] = $this->language->get('entry_taxes');
		$data['entry_age'] = $this->language->get('entry_age');
		$data['entry_document'] = $this->language->get('entry_document');
		$data['entry_comment'] = $this->language->get('entry_comment');

		$data['button_approve'] = $this->language->get('button_approve');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_login'] = $this->language->get('button_login');
		$data['button_unlock'] = $this->language->get('button_unlock');

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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_last_name'])) {
			$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_firm'])) {
			$url .= '&filter_firm=' . $this->request->get['filter_firm'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_taxes'])) {
			$url .= '&filter_taxes=' . $this->request->get['filter_taxes'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('module/partner', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_last_name'] = $this->url->link('module/partner', 'token=' . $this->session->data['token'] . '&sort=c.last_name' . $url, true);
		$data['sort_firm'] = $this->url->link('module/partner', 'token=' . $this->session->data['token'] . '&sort=firm' . $url, true);
		$data['sort_status'] = $this->url->link('module/partner', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, true);
		$data['sort_taxes'] = $this->url->link('module/partner', 'token=' . $this->session->data['token'] . '&sort=c.taxes' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_last_name'])) {
			$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_firm'])) {
			$url .= '&filter_firm=' . $this->request->get['filter_firm'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_taxes'])) {
			$url .= '&filter_taxes=' . $this->request->get['filter_taxes'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $partner_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('module/partner', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($partner_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($partner_total - $this->config->get('config_limit_admin'))) ? $partner_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $partner_total, ceil($partner_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_last_name'] = $filter_last_name;
		$data['filter_firm'] = $filter_firm;
		$data['filter_status'] = $filter_status;
		$data['filter_taxes'] = $filter_taxes;
		
		$this->load->model('module/taxes');
		
		$f_data = array(
			'sort'                     => $sort,
			'order'                    => $order,
			'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                    => $this->config->get('config_limit_admin')
		);

		$data['taxes_forms'] = $this->model_module_taxes->getTaxes($f_data);

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/partner_list', $data));
	}
	
	public function delete() {
		$this->load->language('module/partner');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/partner');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $partner_id) {
				$this->model_module_partner->deletePartner($partner_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_last_name'])) {
				$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_firm'])) {
				$url .= '&filter_firm=' . $this->request->get['filter_firm'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_taxes'])) {
				$url .= '&filter_taxes=' . $this->request->get['filter_taxes'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			

			$this->response->redirect($this->url->link('module/partner', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'module/partner')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	
	
}