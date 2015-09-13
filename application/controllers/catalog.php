<?php
class Catalog extends CI_Controller {
    public function Catalog() {
		parent::__construct();
		$this->load->model('Catalog_model');
    }
	public function index() {
		$pageData['title'] = 'Каталог игр &mdash; главная';
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/catalog/index';
		//$this->db->like(array('approved'=>'1'));
		$this->db->from('games');
		$config['total_rows'] = $this->db->count_all_results(); //$page['news'];
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$pageData['pagination'] = $this->pagination->create_links();
		$pageData['games'] = $this->Catalog_model->getAllGames($config['per_page'], $this->uri->segment(3));
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
	public function add() {
		$page['new']=true;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$page['edit'] = array('title'=>'', 'annotation'=>'', 'id'=>'', 'status'=>'', 'maker'=>'');
		$page['edit']['genre']=false;
		$this->form_validation->set_rules('title', 'Название', 'required');
		$this->form_validation->set_rules('annotation', 'Описание', 'required');
		$this->form_validation->set_rules('genre[]', 'Жанр', 'required');
		$this->form_validation->set_rules('maker[]', 'Движок', 'required');
		$this->form_validation->set_rules('status[]', 'Статус', 'required');
		$page['title'] = 'Rmaker &mdash; Игры &mdash; Добавление новой игры';
		$page['meta_k'] = 'Some shit';
		$page['meta_d'] = 'Some shit';
		//$page['edit'] = array('title'=>'', 'text'=>'');
		if ($this->form_validation->run() === FALSE) {
			$page['success']=false;
			$this->load->view('games/edit', $page);
		} else {
			$this->Catalog_model->add();
			$page['success']=true;
			$this->load->view('games/edit', $page);
		}
	}
	
	public function edit($gameid) {
		$pageData['new']=false;
		$game = $this->Catalog_model->getGameDetails($gameid);
		$pageData['edit'] = array('title'=>$game['title'], 'annotation'=>$game['annotation'], 'id'=>$game['id'], 'status'=>$game['status'], 'maker'=>$game['maker']);
		$pageData['edit']['genre']=explode(', ', $game['genre']);
		//for
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('annotation', 'Annotation', 'required');
		$pageData['title'] = 'Каталог игр &mdash; Редактирование &mdash; '.$game['title'];
		$pageData['meta_k'] = 'Some shit';
		$pageData['meta_d'] = 'Some shit';
		if ($this->form_validation->run() === FALSE) {
			$pageData['success']=false;
			$this->load->view('games/edit', $pageData);
		} else {
			$pageData['success']=true;
			$this->Catalog_model->update($gameid);
			$pageData['info'] = $this->input->post('status');
			$game = $this->Catalog_model->getGameDetails($gameid);
			$pageData['edit'] = array('title'=>$game['title'], 'annotation'=>$game['annotation'], 'id'=>$game['id'], 'status'=>$game['status'], 'maker'=>$game['maker']);
			$pageData['edit']['genre']=explode(', ', $game['genre']);
			$this->load->view('games/edit', $pageData);
		}
		//$this->load->view('games/edit', $pageData);
	}
	public function delete($id) {
		$what = $this->Catalog_model->delete($id);
		if ($what) {
			redirect(base_url().'index.php/catalog');
		}
	}
}