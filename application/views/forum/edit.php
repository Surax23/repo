<?php
	$this->load->view('header');
?>
<div class="games"><div id="news">
<h3>Ответ в теме "<?php echo $topic['title']?>"</h3>

<?php echo form_open('forum/edit/'.$post['id']); ?>

    <label for="text">Сообщение</label><br />
    <textarea name="text" id="editor" ><?php echo $post['text_bb']; ?></textarea><br />
	<br />
    <input type="submit" name="submit" value="Отправить" />
<br />


</div></div>	
<?php
	$this->load->view('footer');
?>