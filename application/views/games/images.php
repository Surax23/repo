<?php
	$this->load->view('header');
?>
<h2>Загрузка изображений для <?php echo $game; ?></h2>
<div class="games">
<form action="#"  enctype="multipart/form-data" method="POST">	
<input type="file" min="1" max="9999" name="file[]" multiple="true" /> <!--будет передан массив файлов -->
<input type="submit" name="load_files" value="Загрузить" />
</form><br /><br />
<?php
	if (isset($error)) {
		echo '<p>'.$error.'</p>';
	} else {
		foreach ($images as $image) {
			echo '<a href="'.base_url().$image.'" rel="rr" onclick="return jsiBoxOpen(this)"><img src="'.base_url().$image.'" width="160" height="120" alt="'.$game.'" /></a>';
		}
	}
?>
</div>
<?php
	$this->load->view('footer');
?>