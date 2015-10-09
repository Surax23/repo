<?php
	$this->load->view('header');
?>

<h2>Добавить игру</h2>
<div class="games">
<?php echo validation_errors(); 
	if (($success)&&($new===true)) {
	echo '<p>Игра успешно добавлена!</p>';
	} else if ($success) {
	echo '<p>Игра успешно обновлена!</p>';
	}
?>

<?php 
	if ($new===true) {
		echo form_open_multipart('catalog/add');
	} else {
		echo form_open('catalog/edit/'.$edit['id']);
	}
	//print_r($edit['genre']);
?>
    <p><label for="title">Название</label><br />
    <input type="input" name="title" value="<?php echo $edit['title']; ?>" /></p>
	<table id="game">
	<tr><td>
	<p><label for="title">Статус</label></p>
	<p><select width="250" size="5" name="status[]">
		<?php
		if ($edit['status']==='в разработке') {
			echo '<option selected value="в разработке">В разработке</option>';
		} else {
			echo '<option value="в разработке">В разработке</option>';
		}
		if ($edit['status']==='завершена') {
			echo '<option selected value="завершена">Завершена</option>';
		} else {
			echo '<option value="завершена">Завершена</option>';
		}
		if ($edit['status']==='демо') {
			echo '<option selected value="демо">Демо</option>';
		} else {
			echo '<option value="демо">Демо</option>';
		}
		if ($edit['status']==='отменена') {
			echo '<option selected value="отменена">Отменена</option>';
		} else {
			echo '<option value="отменена">Отменена</option>';
		}
		if ($edit['status']==='заморожена') {
			echo '<option selected value="заморожена">Заморожена</option>';
		} else {
			echo '<option value="заморожена">Заморожена</option>';
		}
		?>
	</select></p>
	</td>
	<td>
	<label for="title">Мейкер</label></p><p>
	<p><select width="250" size="5" name="maker[]">
		<?php
		if ($edit['maker']==='RPG Maker 95') {
			echo '<option selected value="RPG Maker 95">RPG Maker 95</option>';
		} else {
			echo '<option value="RPG Maker 95">RPG Maker 95</option>';
		}
		if ($edit['maker']==='RPG Maker 2000') {
			echo '<option selected value="RPG Maker 2000">RPG Maker 2000</option>';
		} else {
			echo '<option value="RPG Maker 2000">RPG Maker 2000</option>';
		}
		if ($edit['maker']==='RPG Maker 2003') {
			echo '<option selected value="RPG Maker 2003">RPG Maker 2003</option>';
		} else {
			echo '<option value="RPG Maker 2003">RPG Maker 2003</option>';
		}
		if ($edit['maker']==='RPG Maker XP') {
			echo '<option selected value="RPG Maker XP">RPG Maker XP</option>';
		} else {
			echo '<option value="RPG Maker XP">RPG Maker XP</option>';
		}
		if ($edit['maker']==='RPG Maker VX') {
			echo '<option selected value="RPG Maker VX">RPG Maker VX</option>';
		} else {
			echo '<option value="RPG Maker VX">RPG Maker VX</option>';
		}
		if ($edit['maker']==='RPG Maker VX Ace') {
			echo '<option selected value="RPG Maker VX Ace">RPG Maker VX Ace</option>';
		} else {
			echo '<option value="RPG Maker VX Ace">RPG Maker VX Ace</option>';
		}
		?>
	</select></p>
	</td>
	<td>
	<label for="title">Жанр</label></p><p>
	<p><select width="250" size="5" multiple name="genre[]">
		<?php
		if (array_search('action', $edit['genre'])==false) {
			echo '<option value="action">action</option>';
		} else {
			echo '<option selected value="action">action</option>';
		}
		if (array_search('приключения', $edit['genre'])==false) {
			echo '<option value="приключения">приключения</option>';
		} else {
			echo '<option selected value="приключения">приключения</option>';
		}
		if (array_search('аркада', $edit['genre'])==false) {
			echo '<option value="аркада">аркада</option>';
		} else {
			echo '<option selected value="аркада">аркада</option>';
		}
		if (array_search('юмористическая', $edit['genre'])==false) {
			echo '<option value="юмористическая">юмористическая</option>';
		} else {
			echo '<option selected value="юмористическая">юмористическая</option>';
		}
		if (array_search('киберпанк', $edit['genre'])==false) {
			echo '<option value="киберпанк">киберпанк</option>';
		} else {
			echo '<option selected value="киберпанк">киберпанк</option>';
		}
		if (array_search('нуар', $edit['genre'])==false) {
			echo '<option value="нуар">нуар</option>';
		} else {
			echo '<option selected value="нуар">нуар</option>';
		}
		if (array_search('исследование пещер', $edit['genre'])==false) {
			echo '<option value="исследование пещер">исследование пещер</option>';
		} else {
			echo '<option selected value="исследование пещер">исследование пещер</option>';
		}
		if (array_search('фэнтэзи', $edit['genre'])==false) {
			echo '<option value="фэнтэзи">фэнтэзи</option>';
		} else {
			echo '<option selected value="фэнтэзи">фэнтэзи</option>';
		}
		if (array_search('драки', $edit['genre'])==false) {
			echo '<option value="драки">драки</option>';
		} else {
			echo '<option selected value="драки">драки</option>';
		}
		if (array_search('футуризм', $edit['genre'])==false) {
			echo '<option value="футуризм">футуризм</option>';
		} else {
			echo '<option selected value="футуризм">футуризм</option>';
		}
		if (array_search('историческое', $edit['genre'])==false) {
			echo '<option value="историческое">историческое</option>';
		} else {
			echo '<option selected value="историческое">историческое</option>';
		}
		if (array_search('ужасы', $edit['genre'])==false) {
			echo '<option value="ужасы">ужасы</option>';
		} else {
			echo '<option selected value="ужасы">ужасы</option>';
		}
		if (array_search('современное', $edit['genre'])==false) {
			echo '<option value="современное">современное</option>';
		} else {
			echo '<option selected value="современное">современное</option>';
		}
		if (array_search('многопользовательское', $edit['genre'])==false) {
			echo '<option value="многопользовательское">многопользовательское</option>';
		} else {
			echo '<option selected value="многопользовательское">многопользовательское</option>';
		}
		if (array_search('музыкальное', $edit['genre'])==false) {
			echo '<option value="музыкальное">музыкальное</option>';
		} else {
			echo '<option selected value="музыкальное">музыкальное</option>';
		}
		if (array_search('мистическое', $edit['genre'])==false) {
			echo '<option value="мистическое">мистическое</option>';
		} else {
			echo '<option selected value="мистическое">мистическое</option>';
		}
		if (array_search('старая школа', $edit['genre'])==false) {
			echo '<option value="старая школа">старая школа</option>';
		} else {
			echo '<option selected value="старая школа">старая школа</option>';
		}
		if (array_search('платформер', $edit['genre'])==false) {
			echo '<option value="платформер">платформер</option>';
		} else {
			echo '<option selected value="платформер">платформер</option>';
		}
		if (array_search('постапокалипсис', $edit['genre'])==false) {
			echo '<option value="постапокалипсис">постапокалипсис</option>';
		} else {
			echo '<option selected value="постапокалипсис">постапокалипсис</option>';
		}
		if (array_search('паззл', $edit['genre'])==false) {
			echo '<option value="паззл">паззл</option>';
		} else {
			echo '<option selected value="паззл">паззл</option>';
		}
		if (array_search('ролевая', $edit['genre'])==false) {
			echo '<option value="ролевая">ролевая</option>';
		} else {
			echo '<option selected value="ролевая">ролевая</option>';
		}
		if (array_search('научное', $edit['genre'])==false) {
			echo '<option value="научное">научное</option>';
		} else {
			echo '<option selected value="научное">научное</option>';
		}
		if (array_search('стрелялка', $edit['genre'])==false) {
			echo '<option value="стрелялка">стрелялка</option>';
		} else {
			echo '<option selected value="стрелялка">стрелялка</option>';
		}
		if (array_search('вид сбоку', $edit['genre'])==false) {
			echo '<option value="вид сбоку">вид сбоку</option>';
		} else {
			echo '<option selected value="вид сбоку">вид сбоку</option>';
		}
		if (array_search('симулятор', $edit['genre'])==false) {
			echo '<option value="симулятор">симулятор</option>';
		} else {
			echo '<option selected value="симулятор">симулятор</option>';
		}
		if (array_search('космическое', $edit['genre'])==false) {
			echo '<option value="космическое">космическое</option>';
		} else {
			echo '<option selected value="космическое">космическое</option>';
		}
		if (array_search('стимпанк', $edit['genre'])==false) {
			echo '<option value="стимпанк">стимпанк</option>';
		} else {
			echo '<option selected value="стимпанк">стимпанк</option>';
		}
		if (array_search('стратегия', $edit['genre'])==false) {
			echo '<option value="стратегия">стратегия</option>';
		} else {
			echo '<option selected value="стратегия">стратегия</option>';
		}
		if (array_search('тактика', $edit['genre'])==false) {
			echo '<option value="тактика">тактика</option>';
		} else {
			echo '<option selected value="тактика">тактика</option>';
		}
		if (array_search('текстовая', $edit['genre'])==false) {
			echo '<option value="текстовая">текстовая</option>';
		} else {
			echo '<option selected value="текстовая">текстовая</option>';
		}
		if (array_search('визуальная новелла', $edit['genre'])==false) {
			echo '<option value="визуальная новелла">визуальная новелла</option>';
		} else {
			echo '<option selected value="визуальная новелла">визуальная новелла</option>';
		}
		if (array_search('вестерн', $edit['genre'])==false) {
			echo '<option value="вестерн">вестерн</option>';
		} else {
			echo '<option selected value="вестерн">вестерн</option>';
		}
		?>
	</select></p>
	</td></tr>
	</table>

    <label for="text">Описание</label><br />
    <textarea name="annotation" ><?php echo $edit['annotation']; ?></textarea><br />
	<br />
	<label for="text">Файл</label><br />
	<p><input type="file" name="userfile" size="20" /></p>
	<br />
    <input type="submit" name="submit" value="<?php if ($new===true) { echo 'Добавить игру'; } else { echo 'Обновить игру'; } ?>" />

</form>
</div>
<?php
	$this->load->view('footer');
?>