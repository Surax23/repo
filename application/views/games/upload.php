<?php
	$this->load->view('header');
?>
<h2>Загрузка файла для игры "<?php echo $edit['title'] ?>"</h2>
<div class="games">
Максимальный объем файла: 128Мб.
<?php 
	if (!($error='You did not select a file to upload.')) {
		echo '<p>'.$error.'</p>';
	}
	if ($edit['file']) {
		echo '<p>Загруженный ранее файл: '.$edit['file'].' <a href="'.base_url().'index.php/catalog/delete_upload/'.$edit['id'].'" onClick="return window.confirm(\'Вы действительно хотите удалить файл игры?\')"><img height="16" title="Удалить" alt="Удалить" src="'.base_url().'icon/delete.png"></a></p>';
	}
?>
<?php echo form_open_multipart('catalog/upload/'.$edit['id']);?>

<input type="file" name="userfile" size="20" />
<br /><br />
<input type="submit" value="Загрузить" />
</form>
</div>

<?php
	$this->load->view('footer');
?>