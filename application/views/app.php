<?php
	$this->load->view('header');
?>
<h2>Неутвержденные новости</h2>
<div class="box">
	<div id="news">
	<?php
		$user = $this->ion_auth->user()->row();
		if (isset($errDescription)) {
			echo "<h3>".$errDescription."</h3>";
		}
		else {
			foreach ($news as $new) {
				echo "<h3>".$new['title']."</h3>>> ".$new['date']." || ".$new['author'];
				if ( $this->ion_auth->logged_in() ) {
					echo ' || ';
					echo '<a href="'.base_url().'index.php/news/edit/'.$new['id'].'"><img height="16" title="Редактировать" alt="Редактировать" src="'.base_url().'icon/pencil.png"></a> ';
					echo '<a href="'.base_url().'index.php/news/delete/'.$new['id'].'"><img height="16" title="Удалить" alt="Удалить" src="'.base_url().'icon/delete.png"></a> ';
					echo '<a href="'.base_url().'index.php/news/approve/'.$new['id'].'"><img height="16" title="Утвердить" alt="Утвердить" src="'.base_url().'icon/app.png"></a>';
				}
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