<?php
class News extends CI_Controller {
	public function News() {
		parent::__construct();
		$this->load->model('News_model');
    }
	public function index() {
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/news/index';
		$this->db->like(array('approved'=>'1'));
		$this->db->from('news');
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->db->count_all_results(); //$page['news'];
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		$page['pagination'] = $this->pagination->create_links();
		
		$page['news'] = $this->News_model->getSomeNews($config['per_page'], $this->uri->segment(3));
		if ($page['news'] == false) {
			$page['errDescription'] = "Новостей нет.";
		}
		$page['title'] = 'Rmaker &mdash; новости';
		$page['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
		$page['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
		$this->load->view('news', $page);
	}
	
	public function add() {
		$page['new']=true;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');
		$page['title'] = 'Rmaker &mdash; новости';
		$page['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
		$page['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
		$page['edit'] = array('title'=>'', 'text'=>'', 'text_bb'=>'');
		if ($this->form_validation->run() === FALSE) {
			$page['success']=false;
			$this->load->view('edit', $page);
		} else {
			$this->News_model->addNews();
			$page['success']=true;
			$this->load->view('edit', $page);
		}
	}
	
	public function edit($id) {
		$page['new']=false;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');
		
		//$rules['title']	= "required|xss_clean";
		//$rules['text']	= "required|xss_clean";
		//$this->form_validation->set_rules($rules);
		
		$page['title'] = 'Rmaker &mdash; новости';
		$page['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
		$page['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
		$news = $this->News_model->getOneNews($id);
		$user = $this->ion_auth->user()->row();
		if ($this->ion_auth->is_admin() || $news['author']=$user->username) {
			$page['edit'] = array('title'=>$news['0']['title'], 'text'=>$news['0']['text'], 'id'=>$news['0']['id'], 'text_bb'=>$news['0']['text_bb']);
			if ($this->form_validation->run() === FALSE) {
				$page['success']=false;
				$this->load->view('edit', $page);
			} else {
				$this->News_model->updateNews($id);
				$news = $this->News_model->getOneNews($id);
				$page['edit'] = array('title'=>$news['0']['title'], 'text'=>$news['0']['text'], 'id'=>$news['0']['id'], 'text_bb'=>$news['0']['text_bb']);
				$page['success']=true;
				$this->load->view('edit', $page);
			}
		} else {
			redirect(base_url());
		}
	}
	public function delete($id) {
		if ($this->ion_auth->is_admin()) {
			$what = $this->News_model->delete($id);
			if ($what) {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}
	public function approve($id) {
		if ($this->ion_auth->is_admin()) {
			$this->News_model->approve($id);
			redirect(base_url().'index.php/news/app');
		} else {
			redirect(base_url());
		}
	}
	public function app() {
		if ($this->ion_auth->is_admin()) {
			$this->load->library('pagination');
			$config['base_url'] = base_url().'index.php/news/app';
			$this->db->like(array('approved'=>'0'));
			$this->db->from('news');
			$config['total_rows'] = $this->db->count_all_results(); //$page['news'];
			$config['per_page'] = 5;
			$this->pagination->initialize($config);
			$page['pagination'] = $this->pagination->create_links();
		
			$page['news'] = $this->News_model->notApproved($config['per_page'], $this->uri->segment(3));
			if ($page['news'] == false) {
				$page['errDescription'] = "Новостей нет.";
			}
			$page['title'] = 'Rmaker &mdash; новости';
			$page['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
			$page['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
			$this->load->view('app', $page);
		} else {
			redirect(base_url());
		}
	}
}