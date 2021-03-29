<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_Model', 'Pages');
	}

	public function login($page = 'login')
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$this->load->view('template/header');
        $this->load->view('pages/'.$page);

	}

	public function register($page = 'register_borrower')
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$this->load->view('template/header_main');
		$this->load->view('template/register_header');
        $this->load->view('pages/'.$page);

	}

	public function register_auth($page = 'register_auth')
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$this->load->view('template/header_main');
		$this->load->view('template/register_header');
        $this->load->view('pages/'.$page);

	}

	public function main($page, $equip, $docs)
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$return['equip'] = $this->User_Model->get__borrower_allDetails($equip);
		$this->load->view('template/header_main', $return);
		$return_result['docs'] = $this->User_Model->get__borrower_allDetails($docs);
        $this->load->view('pages/'.$page, $return_result);

	}

	public function borrow($page = 'borrow')
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$this->load->view('template/header_main');
		$this->load->view('pages/modal');
        $this->load->view('pages/'.$page);

	}

	public function admin($page, $equip, $docs, $action, $set_field)
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$return['equip'] = $this->User_Model->get__item_borrower($equip, $action, $set_field);
		$this->load->view('template/header_main', $return);
		$return_result['docs'] = $this->User_Model->get__borrowed_items($docs, $action, $set_field);
        $this->load->view('pages/'.$page, $return_result);

	}

	public function reports($page)
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$return_result['data'] = $this->User_Model->get__reports();
		$this->load->view('template/header_main');
        $this->load->view('pages/'.$page, $return_result);
	}

	public function details($page, $id, $action_taken, $approved)
	{
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$registered_borrower['info'] = $this->Pages->get_borrower($id);
		$this->load->view('template/header_main', $registered_borrower);
		$this->load->view('pages/modal_cancel');
		$this->load->view('pages/modal');
		$borrower['data'] = $this->Pages->get__borrower_details($id, $action_taken, $approved);
        $this->load->view('pages/'.$page, $borrower);

	}	
	
}