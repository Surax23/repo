<?php
	$this->load->view('header');
?>

<h2>Каталог игр</h2>
<div class="games"><div id="news">
	<?php
		if (isset($errDescription)) {
			echo "<h3>".$errDescription."</h3>";
		}
		else {
			//$games = array_reverse($games, true);
			foreach ($games as $game) {
				$arr_tmp = explode(', ', $game['images']);
				$image = $arr_tmp['0'];
				if (!($image === '')) {
					echo '<img class="alignleft" src="'.base_url().$image.'" width="160" height="120" alt="">';
				} else {
					echo '<img class="alignleft" src="'.base_url().'icon/logo.png" width="160" height="120" alt="">';
				}
				echo '<div class="games"><div id="news"><h3>'.anchor('catalog/gamedetails/'.$game['id'], $game['title']);
				if ($this->ion_auth->is_admin()) {
					echo ' <a href="'.base_url().'index.php/catalog/edit/'.$game['id'].'"><img height="16" title="Редактировать" alt="Редактировать" src="'.base_url().'icon/pencil.png"></a> ';
					echo ' <a href="'.base_url().'index.php/catalog/approve/'.$game['id'].'"><img height="16" title="Подтвердить" alt="Подтвердить" src="'.base_url().'icon/app.png"></a> ';
					echo '<a href="'.base_url().'index.php/catalog/upload/'.$game['id'].'"><img height="16" title="Загрузить файл" alt="Загрузить файл" src="'.base_url().'icon/download.png"></a> ';
					echo '<a href="'.base_url().'index.php/catalog/upload_images/'.$game['id'].'"><img height="16" title="Загрузить скриншоты" alt="Загрузить скриншоты" src="'.base_url().'icon/image.png"></a> ';
					echo '<a href="'.base_url().'index.php/catalog/delete/'.$game['id'].'" onClick="return window.confirm(\'Вы действительно хотите удалить запись об игре и связанные с ней файлы?\')"><img height="16" title="Удалить" alt="Удалить" src="'.base_url().'icon/delete.png"></a>';
				}
				echo '</h3>';
				echo '<ul id="page"><li>Автор: '.$game['author'].'</li>';
				echo '<li>Движок: '.$game['maker'].'</li><li class="last">Жанр: '.$game['genre'].'</li></ul></div></div>';
			}
		}
		if (isset($pagination)) {
			echo $pagination;
		}
	?>
</div></div>
	
<?php
	$this->load->view('footer');
?>