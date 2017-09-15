<?php
	class MY_404 extends CI_Controller {
		public function index() {
			$this->output->set_status_header('404'); 
			$data['title'] = 'Page Not Found | IMS Grid';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/404');
			$this->load->view('templates/footer');
		}
	}
?>