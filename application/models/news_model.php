<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		public function getSomeNews($num, $offset) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('news', array('approved'=>'1'),$num, $offset);
			$news = $query->result_array();
			if (count($news) == 0) {
				return false;
			}
			return $news;
		}
		
		public function notApproved($num, $offset) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('news', array('approved'=>'0'),$num, $offset);
			$news = $query->result_array();
			if (count($news) == 0) {
				return false;
			}
			return $news;
		}
		
		public function approve($id) {
			$data = array('approved' => '1');
			$this->db->update('news', $data, array('id'=>$id));
			return true;
		}
		
		public function getOneNews($id) {
			$query = $this->db->get_where('news', array('id'=>$id));
			$news = $query->result_array();
			return $news;
		}
		
		public function addNews() {
			$user = $this->ion_auth->user()->row();
			$data = array(
					'title' => $this->input->post('title'),
					'author' => $user->username,
					'text' => $this->input->post('text')
				);
			$data['text'] = strip_tags($data['text'], '<br><b><i><u><s>');
			if ($this->ion_auth->is_admin()) {
				$data['approved']='1';
			} else {
				$data['approved']='0';
			}
			return $this->db->insert('news', $data);
		}
		public function updateNews($id) {
			$user = $this->ion_auth->user()->row();
			$data = array(
					'title' => $this->input->post('title'),
					//'author' => $user->username,
					'text' => $this->input->post('text')
				);
			$data['text'] = strip_tags($data['text'], '<br><b><i><u><s>');
			if ($this->ion_auth->is_admin()) {
				$data['approved']='1';
			} else {
				$data['approved']='0';
			}
			//$this->db->query('update news set title=?, text=? where id=?', array($data['title'], $data['text'], $id));
			$this->db->update('news', $data, array('id'=>$id));
			return true;
		}
		public function delete($id) {
			$this->db->delete('news', array('id'=>$id));
			return true;
		}
}