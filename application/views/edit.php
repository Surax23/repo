<?php
	$this->load->view('header');
?>

<h2>Добавить новость</h2>
<div class="games">
<?php echo validation_errors(); 
	if (($success)&&($new===true)) {
	echo '<p>Новость успешно добавлена!</p>';
	} else if ($success) {
	echo '<p>Новость успешно обновлена!</p>';
	}
?>

<?php 
	if ($new===true) {
		echo form_open('news/add');
	} else {
		echo form_open('news/edit/'.$edit['id']);
	}
	//print_r($news);
?>
    <label for="title">Название</label><br />
    <input type="input" name="title" value="<?php echo $edit['title']; ?>" /><br />

    <label for="text">Текст</label><br />
    <textarea name="text" ><?php echo $edit['text']; ?></textarea><br />
	<br />
    <input type="submit" name="submit" value="<?php if ($new===true) { echo 'Создать новость'; } else { echo 'Обновить новость'; } ?>" />

</form>
</div>
<?php
	$this->load->view('footer');
?>