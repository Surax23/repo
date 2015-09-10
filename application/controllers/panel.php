<?php
class Panel extends CI_Controller {
    public function Panel() {
		parent::__construct();
		$this->load->model('Panel_model');
    }
	
	public function index () {
		if ( $this->ion_auth->logged_in() ) {
			$pageData['meta_k'] = 'Some shit';
			$pageData['meta_d'] = 'Some shit';
			$pageData['title'] = 'Some more shit';
			$user = $this->ion_auth->user()->row();
			$pageData['games'] = $this->Panel_model->getAllGames($user->username);
			if ($this->Panel_model->getAllGames($user->username)===false) {
				$pageData['error'] = true;
				$this->load->view('panel', $pageData);
			} else {
				$pageData['error'] = false;
				$this->load->view('panel', $pageData);
			}
		} else {
			redirect(base_url(), 'refresh');
		}
	}

}