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
	<p>Тут потом будут скриншоты.</p>
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
				echo '<div class="comments"><a href="'.base_url().'index.php/comments/delete/'.$comment['id'].'/'.$game['id'].'" onClick="return window.confirm(\'Вы действительно хотите удалить комментарий?\')"><img height="16" title="Удалить" alt="Удалить" src="'.base_url().'icon/delete.png"></a> &mdash; <a href="#">'.$comment['author'].'</a> ['.$comment['date'].']:<br />';
				echo $comment['comment'].'</div>';
			}
		}
	?>
	</div><br /><br />
	<h3>Написать комментарий</h3>
	<p>Разрешены HTML-теги &lt;b&gt;, &lt;i&gt;, &lt;u&gt;, &lt;s&gt;, &lt;br&gt;.</p>
	<?php
		echo form_open('comments/add/'.$game['id']);
	?>
	<textarea name="comment" ></textarea><br /><br />
	<input type="submit" name="submit" value="Отправить" />
	</form>
	<!-- <table width="100%"><tr><td>1</td><td>2</td></tr></table> -->
	<?php
		
	?>
	</div></div>
<?php
	$this->load->view('footer');
?>