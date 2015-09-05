<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		public function getSomeNews($num, $offset) {			
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('news',$num, $offset);
			$news = $query->result_array();
			if (count($news) == 0) {
				return false;
			}
			return $news;
		}
}