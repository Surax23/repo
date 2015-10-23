<?php
	$this->load->view('header');
?>
<div class="games"><div id="news">
<h3>Ответ в теме "<?php echo $topic['title']?>"</h3>

<?php echo form_open('forum/reply/'.$topic['id']); ?>

    <label for="text">Сообщение</label><br />
    <textarea name="text" id="editor" ></textarea><br />
	<br />
    <input type="submit" name="submit" value="Отправить" />
<br /><br /><br />
	<h3>Последние десять сообщений:</h3>
	<hr />
<?php
	foreach ($posts as $post) {
		echo '<p><b>'.$post['author'].':</b><br />';
		echo $post['text'].'</p><hr />';
	}
?>


</div></div>	
<?php
	$this->load->view('footer');
?>