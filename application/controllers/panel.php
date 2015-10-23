<?php
class Panel extends CI_Controller {
    public function Panel() {
		parent::__construct();
		$this->load->model('Panel_model');
    }
	
	public function index () {
		if ( $this->ion_auth->logged_in() ) {
			$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
			$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
			$pageData['title'] = 'RMaker &mdash; панель управления';
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