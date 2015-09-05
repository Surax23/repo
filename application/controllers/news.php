<?php
class News extends CI_Controller {
	public function News() {
		parent::__construct();
		$this->load->model('News_model');
    }
	public function index() {
		$page['title'] = 'Rmaker &mdash; новости';
		
		$this->load->library('pagination');
		$config['base_url'] = 'http://localhost/index.php/news/index';
		$config['total_rows'] = $this->db->count_all('news'); //$page['news'];
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		$page['pagination'] = $this->pagination->create_links();
		
		$page['news'] = $this->News_model->getSomeNews($config['per_page'], $this->uri->segment(3));
		if ($page['news'] == false) {
			$page['errDescription'] = "Новостей нет.";
		}
		$page['meta_k'] = 'Some shit';
		$page['meta_d'] = 'Some shit';
		$this->load->view('news', $page);
		
	}
}