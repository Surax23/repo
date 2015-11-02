<?php
class Forum_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	//CATEGORIES
	public function getCats() {
		$query = $this->db->get('forum_cat');
		$cats = $query->result_array();
		if (count($cats) == 0) {
			return false;
		}
		return $cats;
	}
	
	
	// FORUMS
	public function getForums() {
		$query = $this->db->get('forum_forum');
		$forums = $query->result_array();
		if (count($forums) == 0) {
			return false;
		}
		return $forums;
	}
	
	public function getForum($id) {
		$query = $this->db->get_where('forum_forum', array('id'=>$id));
		$forum = $query->result_array();
		return $forum['0'];
	}
	
	
	//TOPICS
	public function getTopics($forum_id, $num, $offset) {
		$this->db->order_by('last_post_time', 'DESC');
		$query = $this->db->get_where('forum_topics', array('forum_id'=>$forum_id), $num, $offset);
		$topics = $query->result_array();
		if (count($topics) == 0) {
			return false;
		}
		return $topics;
	}
	
	public function getTopic($id) {
		$query = $this->db->get_where('forum_topics', array('id'=>$id));
		$topic = $query->result_array();
		if (count($topic) == 0) {
			return false;
		}
		return $topic['0'];
	}
	
	public function addTopic($forum_id) {
		$user = $this->ion_auth->user()->row();
		$this->load->helper('bbcode');
		
		//Update forum_forum
		$dat = array(
				'last_post_author' => $user->username,
				'last_post_subj' => $this->input->post('title'),
				'topic_num' => 'topic_num'+1,
				'post_num' => 'post_num'+1
			);
		$where = array('id' => $forum_id);
		$str0 = $this->db->update_string('forum_forum', $dat, $where);
		$this->db->query($str0);
		
		//Add topic
		$data = array(
				'title' => $this->input->post('title'),
				'author' => $user->username,
				'last_post_author' => $user->username,
				'last_post_subj' => $this->input->post('title'),
				'last_post_time' => time(),
				'forum_id' => $forum_id
			);
		//$data['text'] = strip_tags($data['text'], '<br><b><i><u><s>');
		$str = $this->db->insert_string('forum_topics', $data);
		$this->db->query($str);
		$id = $this->db->insert_id();
		
		//Add post
		$text = $this->input->post('text');
		$text = bbcodes($text);
		$text = strip_tags($text, '<br><br /><b><i><u><s><blockquote><span><a><img><code>');
		$data2 = array(
				'author' => $user->username,
				'text_bb' => $this->input->post('text'),
				'topic_id' => $id,
				'text' => $text
			);
		$str2 = $this->db->insert_string('forum_posts', $data2);
		$this->db->query($str2);
		
		return $id;
	}
	
	// POSTS
	public function getPosts($topic_id, $num, $offset) {
		$this->db->order_by('time', 'ASC');
		$query = $this->db->get_where('forum_posts', array('topic_id'=>$topic_id), $num, $offset);
		$posts = $query->result_array();
		if (count($posts) == 0) {
			return false;
		}
		return $posts;
	}
	
	public function addReply($topic_id) {
		$user = $this->ion_auth->user()->row();
		$this->load->helper('bbcode');
		
		$topic = $this->Forum_model->getTopic($topic_id);
		$data = array(
				'last_post_author' => $user->username,
				'posts' => $topic['posts']+1
			);
		$where = array('id' => $topic_id);
		$string = $this->db->update_string('forum_topics', $data, $where);
		$this->db->query($string);
		
		
		$forum = $this->Forum_model->getForum($topic['forum_id']);
		$dat = array(
				'last_post_author' => $user->username,
				'post_num' => $forum['post_num']+1
			);
		$where2 = array('id' => $topic['forum_id']);
		$str0 = $this->db->update_string('forum_forum', $dat, $where2);
		$this->db->query($str0);
		
		$text = $this->input->post('text');
		$text = bbcodes($text);
		$text = strip_tags($text, '<br><br /><b><i><u><s><blockquote><span><a><img><code>');
		$data2 = array(
				'author' => $user->username,
				'text_bb' => $this->input->post('text'),
				'topic_id' => $topic_id,
				'text' => $text,
				'time' => date("Y-m-d H:i:s")
			);
		$str2 = $this->db->insert_string('forum_posts', $data2);
		$this->db->query($str2);
		
		return true;
	}
	
	public function updateNViews($topic_id) {
		$topic = $this->Forum_model->getTopic($topic_id);
		$data = array(
				'views' => $topic['views']+1
			);
		$where = array('id' => $topic_id);
		$string = $this->db->update_string('forum_topics', $data, $where);
		$this->db->query($string);
		return true;
	}
	
	public function getPost($post_id) {
		$query = $this->db->get_where('forum_posts', array('id'=>$post_id));
		$post = $query->result_array();
		if (count($post) == 0) {
			return false;
		}
		return $post['0'];
	}
	
	public function updatePost($post_id) {
		$this->Forum_model->getPost($post_id);
		$this->load->helper('bbcode');
		$text = $this->input->post('text');
		$text = bbcodes($text);
		$text = strip_tags($text, '<br><br /><b><i><u><s><blockquote><span><a><img><code>');
		$data = array(
				'text_bb' => $this->input->post('text'),
				'text' => $text,
				'last_updated' => date("Y-m-d H:i:s")
			);
		$where = array('id' => $post_id);
		$str = $this->db->update_string('forum_posts', $data, $where);
		$this->db->query($str);
		return true;
	}
}