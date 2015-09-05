<?php
class Site extends CI_Controller {
    public function Site() {
		parent::__construct();
    }
	public function load_template($data) {
		
		
		$this->load->view('header');
		$this->load->view('layout');
		$this->load->view('footer');
	}
}