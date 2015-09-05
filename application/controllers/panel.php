<?php
class Panel extends CI_Controller {
    public function Panel() {
		parent::__construct();
		//$this->load->model('Catalog_model');
    }
	
	public function index () {
		if ( $this->ion_auth->logged_in() ) {
			$pageData['meta_k'] = 'Some shit';
			$pageData['meta_d'] = 'Some shit';
			$this->load->view('panel', $pageData);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

}