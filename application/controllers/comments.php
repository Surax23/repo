<?php
class Comments extends CI_Controller {
    public function Comments() {
		parent::__construct();
		$this->load->model('Comments_model');
    }
	
	public function add($game_id) {
		if ( $this->ion_auth->logged_in() ) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('comment', 'Комментарий', 'required');
			if ($this->form_validation->run() === FALSE) {
				redirect(base_url().'index.php/catalog');
			} else {
				$this->Comments_model->addComment($game_id);
				redirect(base_url().'index.php/catalog/gamedetails/'.$game_id);
			}
		} else {
			redirect(base_url().'index.php/catalog');
		}
	}
	
	public function delete($id, $game_id) {
		if ( $this->ion_auth->is_admin() ) {
			if ($this->Comments_model->deleteComment($id)) {
				redirect(base_url().'index.php/catalog/gamedetails/'.$game_id);
			}
		}
	}
}