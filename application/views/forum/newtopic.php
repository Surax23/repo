<?php
	$this->load->view('header');
?>
<div class="games"><div id="news">
<h3>Новая тема</h3>

<?php echo form_open('forum/newtopic/'.$forum['id']); ?>

	<label for="title">Заголовок</label><br />
    <input type="input" name="title" value="" /><br /><br />
    <label for="text">Сообщение</label><br />
    <textarea name="text" id="editor" ></textarea><br />
	<br />
    <input type="submit" name="submit" value="Отправить" />

</div></div>	
<?php
	$this->load->view('footer');
?>