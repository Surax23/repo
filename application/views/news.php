<?php
	$this->load->view('header');
?>
<h2>Свежие новости</h2>
<div class="box">
	<div id="news">
	<?php
		if (isset($errDescription)) {
			echo "<h3>".$errDescription."</h3>";
		}
		else {
			foreach ($news as $new) {
				echo "<h3>".$new['title']."</h3>>> ".$new['date']." || ".$new['author'];
				echo "<p>".$new['text']."</p>";
			}
		}
	
	echo $pagination;
	?>
	</div>
</div>
<?php
	$this->load->view('footer');
?>