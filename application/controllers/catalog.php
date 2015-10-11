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
		if ( $this->ion_auth->logged_in() ) {
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
				//Загрузка файла
				$user = $this->ion_auth->user()->row();
				$path = './users/'.$user->username.'/';
				if (!is_dir($path)) {
					mkdir($path, 0777, TRUE);
				}
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'rar|zip';
				$config['encrypt_name'] = true;
				//$config['max_size']	= '0';
				$this->load->library('upload', $config);
				if ( !$this->upload->do_upload()) {
					$error = array('error' => $this->upload->display_errors());
					echo 'FUCK YOU!';
					print_r($error);
					//$this->load->view('upload_form', $error);
				} else {
					//$data = $this->upload->data();
					$this->Catalog_model->add($path.$this->upload->data()['file_name']);
					$page['success']=true;
					$this->load->view('games/edit', $page);
					//$this->load->view('upload_success', $data);
				}
				
			}
		} else {
			redirect(base_url().'index.php/catalog');
		}
	}
	
	public function edit($gameid) {
		$game = $this->Catalog_model->getGameDetails($gameid);
		$user = $this->ion_auth->user()->row();
		if ($this->ion_auth->is_admin() || $games['author']=$user->username) {
			$pageData['new']=false;
			$pageData['edit'] = array('title'=>$game['title'], 'annotation'=>$game['annotation'], 'id'=>$game['id'], 'status'=>$game['status'], 'maker'=>$game['maker']);
			$pageData['edit']['genre']=explode(', ', $game['genre']);
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Название', 'required');
			$this->form_validation->set_rules('annotation', 'Описание', 'required');
			$pageData['title'] = 'Каталог игр &mdash; Редактирование &mdash; '.$game['title'];
			$pageData['meta_k'] = 'Some shit';
			$pageData['meta_d'] = 'Some shit';
			if ($this->form_validation->run() === FALSE) {
				$pageData['success']=false;
				$game = $this->Catalog_model->getGameDetails($gameid);
				$pageData['edit'] = array('title'=>$game['title'], 'annotation'=>$game['annotation'], 'id'=>$game['id'], 'status'=>$game['status'], 'maker'=>$game['maker']);
				$pageData['edit']['genre']=explode(', ', $game['genre']);
				//print_r($pageData['edit']['genre']);
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
		} else {
		redirect(base_url());
		}
	}
	public function delete($id) {
		$game = $this->Catalog_model->getGameDetails($id);
		$user = $this->ion_auth->user()->row();
		if ($this->ion_auth->is_admin() || $games['author']=$user->username) {
			$what = $this->Catalog_model->delete($id);
			if ($what) {
				redirect(base_url().'index.php/panel');
			}
		} else {
			redirect(base_url().'index.php/panel');
		}
	}
	
	public function download($id) {
		$this->load->helper('download');
		$game = $this->Catalog_model->getGameDetails($id);
		force_download($game['title'].'.'.end(explode(".", $game['file'])), file_get_contents($game['file']));
	}
}