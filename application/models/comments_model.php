<?php
class Comments_model extends CI_Model {

	public function __construct()
    {
		$this->load->database();
    }
	
	public function getComments($id, $num, $offset) {
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get_where('comments', array('game_id'=>$id), $num, $offset);
		$comments = $query->result_array();
			if (count($comments) == 0) {
				return false;
			}
			return $comments;
	}
	
	public function addComment($game_id) {
		$this->load->helper('bbcode');
		$text = $this->input->post('comment');
		$text = bbcodes($text);
		$text = strip_tags($text, '<br><br /><b><i><u><s><blockquote><span><a><img><code>');
		$user = $this->ion_auth->user()->row();
		$data = array(
				'game_id' => $game_id,
				'author' => $user->username,
				'comment' => $text
			);
		return $this->db->insert('comments', $data);
	}
	
	public function deleteComment($id) {
		$this->db->delete('comments', array('id'=>$id));
		return true;
	}
}