<?php
	$this->load->view('header');
?>
<h2><?php echo $game['title']; ?></h2>
	<?php
		if (isset($errDescription)) {
			echo "<h2>".$errDescription."</h2><br /><br />";
		}
		else {
		echo "<div class='games'><div id='news'>";
		echo "<p>>> Автор: ".$game['author']." || Движок: ".$game['maker']." || Жанр: ".$game['genre']." || Статус: ".$game['status']."</p>";
		echo "<p>Описание<br /> ".$game['annotation']."</p>";
		echo "<p><a href='".base_url().'index.php/catalog/download/'.$game['id']."'><img src='".base_url()."/icon/button.png'></a></p>";
		echo "</div></div>";
		}
	?>
<?php
	$this->load->view('footer');
?>