<?php
class News extends CI_Controller {
	public function News() {
		parent::__construct();
		$this->load->model('News_model');
    }
	public function index() {
		
		$this->load->library('pagination');
		$config['base_url'] = 'http://localhost/index.php/news/index';
		$this->db->like(array('approved'=>'1'));
		$this->db->from('news');
		$config['total_rows'] = $this->db->count_all_results(); //$page['news'];
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		$page['pagination'] = $this->pagination->create_links();
		
		$page['news'] = $this->News_model->getSomeNews($config['per_page'], $this->uri->segment(3));
		if ($page['news'] == false) {
			$page['errDescription'] = "Новостей нет.";
		}
		$page['title'] = 'Rmaker &mdash; новости';
		$page['meta_k'] = 'Some shit';
		$page['meta_d'] = 'Some shit';
		$this->load->view('news', $page);
		
	}
	public function add() {
		$page['new']=true;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');
		$page['title'] = 'Rmaker &mdash; новости';
		$page['meta_k'] = 'Some shit';
		$page['meta_d'] = 'Some shit';
		$page['edit'] = array('title'=>'', 'text'=>'');
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
		$page['title'] = 'Rmaker &mdash; новости';
		$page['meta_k'] = 'Some shit';
		$page['meta_d'] = 'Some shit';
		$news = $this->News_model->getOneNews($id);
		$page['edit'] = array('title'=>$news['0']['title'], 'text'=>$news['0']['text'], 'id'=>$news['0']['id']);
		if ($this->form_validation->run() === FALSE) {
			$page['success']=false;
			$this->load->view('edit', $page);
		} else {
			$this->News_model->updateNews($id);
			$page['success']=true;
			//$this->load->view('edit', $page);
			redirect(base_url().'index.php/news/edit/'.$id);
		}
		//$this->load->view('edit', $page);
	}
	public function delete($id) {
		$what = $this->News_model->delete($id);
		if ($what) {
			redirect(base_url());
		}
	}
	public function approve($id) {
		$this->News_model->approve($id);
		redirect(base_url().'index.php/news/app');
	}
	public function app() {
		$this->load->library('pagination');
		$config['base_url'] = 'http://localhost/index.php/news/index';
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
		$page['meta_k'] = 'Some shit';
		$page['meta_d'] = 'Some shit';
		$this->load->view('app', $page);
	}
}