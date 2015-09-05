<?php
	$this->load->view('header');
?>
<h2>Каталог игр</h2>
	<?php
		if (isset($errDescription)) {
			echo "<h1>".$errDescription."</h1>";
		}
		else {
			//$games = array_reverse($games, true);
			foreach ($games as $game) {
				echo "<img class='alignleft' src='http://rmaker.ru/forum/styles/basic/theme/images/logo.png' width='160' alt=''>";
				echo "<div class='games'><div id='news'><h3>".anchor('catalog/gamedetails/'.$game['id'], $game['title'])."</h3>";
				echo "<ul id='page'><li>Автор: ".$game['author']."</li>";
				echo "<li>Движок: ".$game['maker']."</li><li class='last'>Жанр: ".$game['genre']."</li></ul></div></div>";
			}
		}
	?>
	
<?php
	$this->load->view('footer');
?>