<?php
class Catalog extends CI_Controller {
    public function Catalog() {
		parent::__construct();
		$this->load->model('Catalog_model');
    }
	public function index() {
		$pageData['title'] = 'Каталог игр &mdash; главная';
		$pageData['games'] = $this->Catalog_model->getAllGames();
		if ($pageData['games'] == false) {
			$pageData['errDescription'] = "Игр нет.";
		}
		$pageData['meta_k'] = 'Some shit';
		$pageData['meta_d'] = 'Some shit';
		$this->load->view('main', $pageData);
	}
	public function gamedetails($gameid) {
		$pageData['game'] = $this->Catalog_model->getGameDetails($gameid);
		if ($pageData['game'] == false) {
			$pageData['errDescription'] = "Игры не существует.";
		}
		$pageData['title'] = 'Каталог игр &mdash; '.$pageData['game']['title'];
		$pageData['meta_k'] = 'Some shit';
		$pageData['meta_d'] = 'Some shit';
		$this->load->view("details", $pageData);
	}
	public function addNewGame() {
		//Blah
	}
}