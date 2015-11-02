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
		echo "<h3>Описание</h3><p>".$game['annotation']."</p>";
	?>
	<h3>Скриншоты</h3>
<p><?php
	//print_r($images);
	if ($error) {
		echo '<p>Изображения отсутствуют.</p>';
	} else {
		foreach ($images_g as $image) {
			echo '<a href="'.base_url().$image.'" rel="rr" onclick="return jsiBoxOpen(this)"><img src="'.base_url().$image.'" width="160" height="120" alt="'.$game['title'].'" /></a> ';
		}
	}
?></p>
	<?php
		if (file_exists($game['file'])) {
			echo "<p><a href='".base_url().'index.php/catalog/download/'.$game['id']."'><img src='".base_url()."/icon/button.png'></a></p>";
		} else {
			echo "<p style='color: #3333FF'>Пользователь не добавил файлов для загрузки.</p>";
		}
		echo "</div></div>";
		}
	?>
	<div class='games'><div id='news'>
	<h3>Последние записи блога</h3>
	<p>В разработке...</p>
	<hr /><br />
	<h3>Комментарии:</h3>
	<div>
	<?php
		if ($comments === false) {
			echo '<p>Комментариев нет</p>';
		} else {
			foreach ($comments as $comment) {
				if ($this->ion_auth->is_admin()) {
					echo '<div class="comments"><a href="'.base_url().'index.php/comments/delete/'.$comment['id'].'/'.$game['id'].'" onClick="return window.confirm(\'Вы действительно хотите удалить комментарий?\')"><img height="16" title="Удалить" alt="Удалить" src="'.base_url().'icon/delete.png"></a>';
				} else {
					echo '<div class="comments">';
				}
				echo '&mdash; <a href="#">'.$comment['author'].'</a> ['.$comment['date'].']:<br />';
				echo $comment['comment'].'</div>';
			}
		}
	?>
	</div><br /><br />
<?php
	if ($this->ion_auth->logged_in()) {
		echo '<h3>Написать комментарий</h3>';
		echo form_open('comments/add/'.$game['id']);
		echo '<textarea name="comment"  id="editor"></textarea><br /><br />';
		echo '<input type="submit" name="submit" value="Отправить" />';
		echo '</form>';
	}
?>
	</div></div>
<?php
	$this->load->view('footer');
?>