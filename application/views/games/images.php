<?php
	$this->load->view('header');
?>
<h2>Загрузка изображений для <?php echo $game['title'] ?></h2>
<div class="games">
<form action=""  enctype="multipart/form-data" method="POST">	
<input type="file" min="1" max="9999" name="file[]" multiple="true" /> <!--будет передан массив файлов -->
<input type="submit" name="load_files" value="Загрузить" />
</form><br /><br />
<?php
	if ($error) {
		echo '<p>Изображения отсутствуют.</p>';
	} else {
		foreach ($images as $image) {
			$len = strlen('users/'.$game['author'].'/img/');
			$tmp = substr($image, $len);
			echo '<div valign="top"><a href="'.base_url().$image.'" rel="rr" onclick="return jsiBoxOpen(this)"><img src="'.base_url().$image.'" width="320" height="240" alt="'.$game['title'].'" /></a> <a href="'.base_url().'index.php/catalog/delete_image/'.$game['id'].'/'.$tmp.'">Удалить</a></div>';
		}
	}
	//print_r($images);
?>
</div>
<?php
	$this->load->view('footer');
?>