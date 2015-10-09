<?php
class Panel_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		public function getAllGames($name) {
			$qGetAll = "SELECT * FROM games WHERE author=?";
			$res = $this->db->query($qGetAll, array($name));
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
}