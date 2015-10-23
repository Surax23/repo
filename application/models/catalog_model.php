<?php
class Catalog_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		public function getAllGames($num, $offset) {
			$this->db->order_by('id', 'RANDOM');
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
		
		public function getSearchGames($num, $offset, $param, $key) {
			//$this->db->order_by('id', 'DESC');
			$this->db->where($param, $key);
			$query = $this->db->get('games', $num, $offset);
			print_r($query);
			$games = $query->result_array();
			if (count($games) == 0) {
				return false;
			}
			return $games;
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
			$data = array(
					'title' => $this->input->post('title'),
					'author' => '',
					'annotation' => $text,
					'text_bb' => $this->input->post('annotation'),
					'maker' => $this->input->post('maker')['0'],
					'status' => $this->input->post('status')['0']
				);
			if ($this->ion_auth->is_admin()) {
				$data['approved']='1';
			} else {
				$data['approved']='0';
			}
			if ($this->ion_auth->is_admin()) {
				$data['author'] = $this->input->post('author');
			} else {
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
			$data = array(
					'title' => $this->input->post('title'),
					'annotation' => $text,
					'text_bb' => $this->input->post('annotation'),
					'maker' => $this->input->post('maker')['0'],
					'status' => $this->input->post('status')['0']
				);
			$data['annotation']=strip_tags($data['annotation'], '<br><b><i><u><s>');
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
			//$data = array('images' => $images);
			//$this->db->set('images', 'CONCAT(images, '.$images);
			//$this->db->select('CONCAT (images, ", ",'.$images.')');
			$this->db->set('images', 'CONCAT(images, ", ", "'.$images.'")', FALSE);
			return $this->db->update('games'/*, $data, array('id'=>$id)*/);
		}
		
		public function upload_images($id, $images) {
			$data = array('images' => $images);
			return $this->db->update('games', $data, array('id'=>$id));
		}
		
		public function delete_image($id, $image, $name) {
			//$data = array('images' => $image);
			//$image = $this->db->escape($image);
			//echo $image;
			//echo $image;
			$this->db->set('images', 'REPLACE(images, "'.$image.'", "")', FALSE);
			return $this->db->update('games', null, array('id'=>$id));
		}
		
		public function delete($id) {
			$this->db->delete('games', array('id'=>$id));
			return true;
		}
}