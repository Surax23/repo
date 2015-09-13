<?php
	$this->load->view('header');
?>
<h2>Каталог игр</h2>
<div class="games"><div id="news">
	<?php
		if (isset($errDescription)) {
			echo "<h1>".$errDescription."</h1>";
		}
		else {
			//$games = array_reverse($games, true);
			foreach ($games as $game) {
				echo '<img class="alignleft" src="'.base_url().'/forum/styles/basic/theme/images/logo.png" width="160" height="120" alt="">';
				echo '<div class="games"><div id="news"><h3>'.anchor('catalog/gamedetails/'.$game['id'], $game['title']);
				if ($this->ion_auth->is_admin()) {
					echo ' <a href="'.base_url().'index.php/catalog/edit/'.$game['id'].'"><img height="16" title="Редактировать" alt="Редактировать" src="'.base_url().'icon/pencil.png"></a> ';
					echo '<a href="'.base_url().'index.php/catalog/delete/'.$game['id'].'"><img height="16" title="Удалить" alt="Удалить" src="'.base_url().'icon/delete.png"></a>';
				}
				echo '</h3>';
				echo '<ul id="page"><li>Автор: '.$game['author'].'</li>';
				echo '<li>Движок: '.$game['maker'].'</li><li class="last">Жанр: '.$game['genre'].'</li></ul></div></div>';
			}
		}
		echo $pagination;
	?>
</div></div>
	
<?php
	$this->load->view('footer');
?>