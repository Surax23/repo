<?php
class Maintain extends CI_Controller {
    public function Maintain() {
		parent::__construct();
    }
	
	public function index() {
		$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
		$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
		$pageData['title'] = 'RMaker &mdash; пожертвование';
		$this->load->view('maintain', $pageData);
	}
}