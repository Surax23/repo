<?php
class Catalog_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		public function getAllGames($num, $offset) {
			//$this->db->order_by('id', 'DESC');
			$query = $this->db->get('games', $num, $offset);
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
			$data = array(
					'title' => $this->input->post('title'),
					'author' => '',
					'annotation' => $this->input->post('annotation'),
					'maker' => $this->input->post('maker')['0'],
					'status' => $this->input->post('status')['0'],
					//'file' => $file
				);
			if ($this->ion_auth->is_admin()) {
				$data['author'] = $this->input->post('author');
			} else {
				$user = $this->ion_auth->user()->row();
				$data['author'] = $user->username;
			}
			$data['annotation']=strip_tags($data['annotation'], '<br><b><i><u><s>');
			$data['genre']=null;
			$data['genre']=$this->input->post('genre')['0'];
			for($i=1;$i<count($this->input->post('genre'));$i++) {
				$data['genre']=$data['genre'].', '.$this->input->post('genre')[$i];
			}
			return $this->db->insert('games', $data);
		}
		
		public function update($id) {
			//$user = $this->ion_auth->user()->row();
			//$data['annotation']=strip_tags($this->input->post('annotation')['0'], '<b><i><u><s>');
			$data = array(
					'title' => $this->input->post('title'),
					//'author' => $user->username,
					'annotation' => $this->input->post('annotation'),
					'maker' => $this->input->post('maker')['0'],
					'status' => $this->input->post('status')['0'],
					//'genre' => $this->input->post('genre')
					//'file' => $file
				);
			$data['annotation']=strip_tags($data['annotation'], '<br><b><i><u><s>');
			$data['genre']=null;
			$data['genre']=$this->input->post('genre')['0'];
			for($i=1;$i<count($this->input->post('genre'));$i++) {
				$data['genre']=$data['genre'].', '.$this->input->post('genre')[$i];
			}
			//$data['status']=$this->input->post('status')['0'];
			
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
		
		public function upload_images($id, $images) {
			$data = array('images' => $images);
			return $this->db->update('games', $data, array('id'=>$id));
		}
		
		public function delete($id) {
			$this->db->delete('games', array('id'=>$id));
			return true;
		}
}