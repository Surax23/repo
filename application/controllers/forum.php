<?php
class Forum extends CI_Controller {
    public function Forum() {
		parent::__construct();
		$this->load->model('Forum_model');
    }
	
	public function index() {
		$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
		$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
		$pageData['title'] = 'RMaker &mdash; форумы';
		$pageData['cats'] = $this->Forum_model->getCats();
		$pageData['forums'] = $this->Forum_model->getForums();
		$this->load->view('forum/index', $pageData);
	}
	
	public function view($forum_id) {
		$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
		$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
		$pageData['f_name'] = $this->Forum_model->getForum($forum_id);
		$pageData['title'] = 'RMaker &mdash; форум &mdash; '.$pageData['f_name']['name'];
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/forum/view/'.$forum_id;
		$this->db->like(array('forum_id'=>$forum_id));
		$this->db->from('forum_topics');
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 15;
		$this->pagination->initialize($config);
		$pageData['pagination'] = $this->pagination->create_links();
		
		$pageData['topics'] = $this->Forum_model->getTopics($forum_id, $config['per_page'], $this->uri->segment(4));
		$this->load->view('forum/topics', $pageData);
	}
	
	public function newtopic($forum_id) {
		$frm_d = $forum_id;
		if ( $this->ion_auth->logged_in() ) {
			$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
			$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
			$pageData['title'] = 'RMaker &mdash; форумы &mdash; новая тема';
			$pageData['forum'] = $this->Forum_model->getForum($forum_id);
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Заголовок', 'required');
			$this->form_validation->set_rules('text', 'текст', 'required');
			if ($this->form_validation->run() === FALSE) {
				$page['success']=false;
				$this->load->view('forum/newtopic', $pageData);
			} else {
				$topic_id = $this->Forum_model->addTopic($forum_id);
				$page['success']=true;
				redirect(base_url().'index.php/forum/topic/'.$topic_id);
			}
		} else {
			redirect(base_url().'index.php/forum/view/'.$frm_d);
		}
	}
	
	public function topic($topic_id) {
		$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
		$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
		$this->Forum_model->updateNViews($topic_id);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/forum/topic/'.$topic_id;
		$config['uri_segment'] = 4;
		$this->db->like(array('topic_id'=>$topic_id));
		$this->db->from('forum_posts');
		$config['total_rows'] = $this->db->count_all_results();
		//print_r($config['total_rows']);
		$config['per_page'] = 15;
		$this->pagination->initialize($config);
		$pageData['pagination'] = $this->pagination->create_links();
		
		$pageData['topic'] = $this->Forum_model->getTopic($topic_id);
		$pageData['title'] = 'RMaker &mdash; форум &mdash; '.$pageData['topic']['title'];
		
		$pageData['posts'] = $this->Forum_model->getPosts($topic_id, $config['per_page'], $this->uri->segment(4));
		$this->load->view('forum/topic', $pageData);
	}
	
	public function reply($topic_id) {
		$tp_d = $topic_id;
		if ( $this->ion_auth->logged_in() ) {
			$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
			$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
			$pageData['topic'] = $this->Forum_model->getTopic($topic_id);
			$pageData['title'] = 'RMaker &mdash; форум &mdash; ответ в '.$pageData['topic']['title'];;
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('text', 'текст', 'required');
			
			$pageData['posts'] = $this->Forum_model->getPosts($topic_id, 10, $this->uri->segment(4));
			if ($this->form_validation->run() === FALSE) {
				$page['success']=false;
				$this->load->view('forum/reply', $pageData);
				//redirect(base_url().'index.php/forum/reply/'.$topic_id);
			} else {
				$this->Forum_model->addReply($topic_id);
				$page['success']=true;
				redirect(base_url().'index.php/forum/topic/'.$tp_d);
			}
		} else {
			redirect(base_url().'index.php/forum/topic/'.$tp_d);
		}
	}
	
	public function edit($post_id) {
		//$pt_d = $post_id;
		$user = $this->ion_auth->user()->row();
		$post = $this->Forum_model->getPost($post_id);
		if (($this->ion_auth->logged_in()) && ($post['author']=$user->username)) {
			$pageData['meta_k'] = 'rpg maker, rpgmaker, rpg maker vx, rpgmakervx, rpg maker vx ace, rpgmakervxace, создание игр, игры, разработка игр, RPG игры, RPG, jRPG, скачать игры';
			$pageData['meta_d'] = 'RMaker - портал для разработчиков игр и игроков. Здесь можно разместить свою игру на RPG Maker или же скачать игру по нраву.';
			$pageData['topic'] = $this->Forum_model->getTopic($post['topic_id']);
			$pageData['title'] = 'RMaker &mdash; форум &mdash; редактирование сообщения в '.$pageData['topic']['title'];
			$pageData['post'] = $post;
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('text', 'текст', 'required');
			
			//$pageData['posts'] = $this->Forum_model->getPosts($topic_id, 10, $this->uri->segment(4));
			if ($this->form_validation->run() === FALSE) {
				$page['success']=false;
				$this->load->view('forum/edit', $pageData);
			} else {
				$this->Forum_model->updatePost($post_id);
				$page['success']=true;
				redirect(base_url().'index.php/forum/topic/'.$pageData['topic']['id']);
			}
		} else {
			redirect(base_url().'index.php/forum/topic/'.$pageData['topic']['id']);
		}
	}
	
}