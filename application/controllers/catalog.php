<?php
class Catalog extends CI_Controller {
    public function Catalog() {
		parent::__construct();
		$this->load->model('Catalog_model');
		$this->load->model('Comments_model');
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
	
	public function search($param, $key) {
		$pageData['title'] = 'Каталог игр &mdash; поиск';
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/catalog/search/'.$param.'/'.$key;
		//$this->db->like(array('approved'=>'1'));
		$this->db->select($param);
		$this->db->where($param, $key);
		$this->db->from('games');
		$config['total_rows'] = $this->db->count_all_results(); //$page['news'];
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$pageData['pagination'] = $this->pagination->create_links();
		$pageData['games'] = $this->Catalog_model->getSearchGames($config['per_page'], $this->uri->segment(5), $param, $key);
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
		$this->load->helper('form');
		$pageData['comments'] = $this->Comments_model->getComments($gameid, 10, 0);
		$this->load->view("details", $pageData);
	}
	public function add() {
		if ( $this->ion_auth->logged_in() ) {
			$page['new']=true;
			$this->load->helper('form');
			$this->load->library('form_validation');
			$page['edit'] = array('title'=>'', 'annotation'=>'', 'id'=>'', 'status'=>'', 'maker'=>'', 'author'=>'');
			$page['edit']['genre']=false;
			$this->form_validation->set_rules('title', 'Название', 'required');
			$this->form_validation->set_rules('annotation', 'Описание', 'required');
			$this->form_validation->set_rules('genre[]', 'Жанр', 'required');
			$this->form_validation->set_rules('maker[]', 'Движок', 'required');
			$this->form_validation->set_rules('status[]', 'Статус', 'required');
			$page['title'] = 'Rmaker &mdash; Игры &mdash; Добавление новой игры';
			$page['meta_k'] = 'Some shit';
			$page['meta_d'] = 'Some shit';
			if ($this->form_validation->run() === FALSE) {
				$page['success']=false;
				$this->load->view('games/edit', $page);
			} else {
				$this->Catalog_model->add();
				$page['success']=true;
				$this->load->view('games/edit', $page);
			}
		} else {
			redirect(base_url().'index.php/catalog');
		}
	}
	
	public function edit($gameid) {
		$game = $this->Catalog_model->getGameDetails($gameid);
		$user = $this->ion_auth->user()->row();
		if ($this->ion_auth->is_admin() || $game['author']=$user->username) {
			$pageData['new']=false;
			$pageData['edit'] = array('title'=>$game['title'], 'author'=>$game['author'], 'annotation'=>$game['annotation'], 'id'=>$game['id'], 'status'=>$game['status'], 'maker'=>$game['maker']);
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
				$pageData['edit'] = array('title'=>$game['title'], 'author'=>$game['author'], 'annotation'=>$game['annotation'], 'id'=>$game['id'], 'status'=>$game['status'], 'maker'=>$game['maker']);
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
		if ($this->ion_auth->is_admin() || $game['author']=$user->username) {
			unlink($game['file']);
			$what = $this->Catalog_model->delete($id);
			if ($what) {
				redirect(base_url().'index.php/panel');
			}
		} else {
			redirect(base_url().'index.php/panel');
		}
	}
	
	public function upload($id) {
		$game = $this->Catalog_model->getGameDetails($id);
		$user = $this->ion_auth->user()->row();
		if ($this->ion_auth->is_admin() || $game['author']=$user->username) {
			$this->load->helper('form');
			$pageData['edit'] = array('title'=>$game['title'], 'annotation'=>$game['annotation'], 'id'=>$game['id'], 'status'=>$game['status'], 'maker'=>$game['maker'], 'file'=>$game['file']);
			$pageData['title'] = 'Каталог игр &mdash; Загрузка файла &mdash; '.$game['title'];
			$pageData['meta_k'] = 'Some shit';
			$pageData['meta_d'] = 'Some shit';
			$pageData['error'] = '';
			$path = './users/'.$game['author'].'/';
			if (!is_dir($path)) {
				mkdir($path, 0777, TRUE);
			}
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'rar|zip';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if ( !$this->upload->do_upload()) {
				$pageData['error'] = $this->upload->display_errors();
				$this->load->view('games/upload', $pageData);
			} else {
				$pageData['error'] = array();
				$this->Catalog_model->upload($game['id'], $path.$this->upload->data()['file_name']);
				redirect(base_url().'index.php/catalog/upload/'.$game['id']);
			}
		}
	}
	
	public function delete_upload($id) {
		$game = $this->Catalog_model->getGameDetails($id);
		$user = $this->ion_auth->user()->row();
		if ($this->ion_auth->is_admin() || $game['author']=$user->username) {
			unlink($game['file']);
			$what = $this->Catalog_model->delete_upload($id);
			if ($what) {
				redirect(base_url().'index.php/catalog/upload/'.$game['id']);
			}
		} else {
			redirect(base_url().'index.php/panel');
		}
	}
	
	public function upload_images($id) {
		$game = $this->Catalog_model->getGameDetails($id);
		$user = $this->ion_auth->user()->row();
		$string = '';
		//$pageData['images'] = null;
		if ($this->ion_auth->is_admin() || $game['author']=$user->username) {
			if ($this->input->post('load_files')) {
				$path = './users/'.$game['author'].'/img/';
				if (!is_dir($path)) {
					mkdir($path, 0777, TRUE);
				}
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'jpg|png|gif';
				$config['max_size']	= '2048';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$temp_files = $_FILES;
				$count = count($_FILES['file']['name']);
				if ($count>0) {
				for ($i=0; $i<=$count-1; $i++)
					{
						$_FILES['file'] = array (
						'name'=>$temp_files['file']['name'][$i],
						'type'=>$temp_files['file']['type'][$i],
						'tmp_name'=>$temp_files['file']['tmp_name'][$i],
						'error'=>$temp_files['file']['error'][$i],
						'size'=>$temp_files['file']['size'][$i]);
						$this->upload->do_upload('file');
						$tmp_data = $this->upload->data();
						$files_data[$i]['data'] = $tmp_data['full_path'];
						$string = $string.stristr($tmp_data['full_path'], '/users/').', ';
				}
				}
			}
			//print_r($string);
			$this->Catalog_model->upload_images($game['id'], $string);
			$pageData['title'] = 'Каталог игр &mdash; Загрузка изображений &mdash; '.$game['title'];
			$pageData['images'] = $game['images'];
			print_r($pageData['images']);
			$pageData['images'] = substr($game['images'], 0, -2);
			$pageData['images'] = explode(', ', $game['images']);
			$pageData['game'] = $game['title'];
			//print_r($pageData['images']);
			$pageData['meta_k'] = 'Some shit';
			$pageData['meta_d'] = 'Some shit';
			$this->load->view('games/images', $pageData);
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