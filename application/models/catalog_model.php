<?php
class Catalog_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
		public function approve($id) {
			$data = array('approved' => '1');
			$this->db->update('games', $data, array('id'=>$id));
			return true;
		}
		
		public function getAllGames($num, $offset) {
			//$this->db->order_by('id', 'RANDOM');
			$query = $this->db->get_where('games', array('approved'=>'1'), $num, $offset);
			$games = $query->result_array();
			if (count($games) == 0) {
				return false;
			}
			return $games;
		}
		
		public function notApproved($num, $offset) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('games', array('approved'=>'0'),$num, $offset);
			$games = $query->result_array();
			if (count($games) == 0) {
				return false;
			}
			return $games;
		}
		
		public function getSearchGames($param) {
			//$this->db->order_by($param, 'DESC');
			$this->db->like($param);
			$query = $this->db->get('games');
			//print_r($query);
			$games = $query->result_array();
			if (count($games) == 0) {
				return false;
			}
			return $games;
		}
		
		public function searchCount($param) {
			$this->db->like($param);
			$this->db->from('games');
			$cnt = $this->db->count_all_results();
			return $cnt;
		}
		
		public function getGameDetails($gameId) {
			$qGetGame = "SELECT * FROM games WHERE id=?";
			$res = $this->db->query($qGetGame, array($gameId));
			$gameData = $res->result_array();
			if (count($gameData) == 0) {
				return false;
			}
			return $gameData[0];
		}
		
		public function add() {
			$this->load->helper('bbcode');
			$text = $this->input->post('annotation');
			$text = bbcodes($text);
			$text = strip_tags($text, '<br><br /><b><i><u><s><blockquote><span><a><img><code>');
			$data = array(
					'title' => strip_tags($this->input->post('title')),
					'author' => '',
					'annotation' => $text,
					'text_bb' => $this->input->post('annotation'),
					'maker' => $this->input->post('maker')['0'],
					'status' => $this->input->post('status')['0']
				);
			if ($this->ion_auth->is_admin()) {
				$data['approved']='1';
				$data['author'] = $this->input->post('author');
			} else {
				$data['approved']='0';
				$user = $this->ion_auth->user()->row();
				$data['author'] = $user->username;
			}
			$data['genre']=null;
			$data['genre']=$this->input->post('genre')['0'];
			for($i=1;$i<count($this->input->post('genre'));$i++) {
				$data['genre']=$data['genre'].', '.$this->input->post('genre')[$i];
			}
			return $this->db->insert('games', $data);
		}
		
		public function update($id) {
			$this->load->helper('bbcode');
			$text = $this->input->post('annotation');
			$text = bbcodes($text);
			$text = strip_tags($text, '<br><br /><b><i><u><s><blockquote><span><a><img><code>');
			$data = array(
					'title' => strip_tags($this->input->post('title')),
					'annotation' => $text,
					'text_bb' => $this->input->post('annotation'),
					'maker' => $this->input->post('maker')['0'],
					'status' => $this->input->post('status')['0']
				);
			$data['genre']=null;
			$data['genre']=$this->input->post('genre')['0'];
			for($i=1;$i<count($this->input->post('genre'));$i++) {
				$data['genre']=$data['genre'].', '.$this->input->post('genre')[$i];
			}
			
			return $this->db->update('games', $data, array('id'=>$id));
		}
		
		public function upload($id, $file) {
			$data = array('file' => $file);
			return $this->db->update('games', $data, array('id'=>$id));
		}
		
		public function delete_upload($id) {
			$data = array('file' => null);
			return $this->db->update('games', $data, array('id'=>$id));
		}
		
		public function update_images($id, $images) {
			$this->db->set('images', 'CONCAT(images, ", ", "'.$images.'")', FALSE);
			return $this->db->update('games');
		}
		
		public function upload_images($id, $images) {
			$data = array('images' => $images);
			return $this->db->update('games', $data, array('id'=>$id));
		}
		
		public function delete_image($id, $image, $name) {
			$data = array('$image' => null);
			$this->db->set('images', 'REPLACE(images, "'.$image.'", "")', FALSE);
			return $this->db->update('games', null, array('id'=>$id));
		}
		
		public function delete($id) {
			$this->db->delete('games', array('id'=>$id));
			return true;
		}
}