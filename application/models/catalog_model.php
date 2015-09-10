<?php
class Catalog_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		public function getAllGames() {
			$qGetAll = "SELECT id, title, author, genre, maker FROM games";
			$res = $this->db->query($qGetAll);
			$gamesData = $res->result_array();
			if (count($gamesData) == 0) {
				return false;
			}
			return $gamesData;
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
		
		public function addGame() {
			//Blah
		}
		
		public function updateGame($id) {
			//Blah
		}
}