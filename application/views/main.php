<?php
	$this->load->view('header');
?>

<div id="search">
<?php
	echo form_open('catalog/search');
	
?>

Название: <input type="input" name="title" value="" /></p>
Автор: <input type="input" name="author" value="" /></p>

Статус:
<select width="250" size="1" name="status">
	<option value="">&mdash;</option>
	<option value="в разработке">В разработке</option>
	<option value="завершена">Завершена</option>
	<option value="демо">Демо</option>
	<option value="отменена">Отменена</option>
	<option value="заморожена">Заморожена</option>
</select>
Движок:
<select width="250" size="1" name="maker">
	<option value="">&mdash;</option>
	<option value="RPG Maker 95">RPG Maker 95</option>
	<option value="RPG Maker 2000">RPG Maker 2000</option>
	<option value="RPG Maker 2003">RPG Maker 2003</option>
	<option value="RPG Maker XP">RPG Maker XP</option>
	<option value="RPG Maker VX">RPG Maker VX</option>
	<option value="RPG Maker VX Ace">RPG Maker VX Ace</option>
	<option value="RPG Maker MV">RPG Maker MV</option>
</select>
Жанр:
<select width="250" size="5" multiple name="genre[]">
	<option value="action">action</option>
	<option value="приключения">приключения</option>
	<option value="аркада">аркада</option>
	<option value="юмористическая">юмористическая</option>
	<option value="киберпанк">киберпанк</option>
	<option value="нуар">нуар</option>
	<option value="исследование пещер">исследование пещер</option>
	<option value="фэнтэзи">фэнтэзи</option>
	<option value="драки">драки</option>
	<option value="футуризм">футуризм</option>
	<option value="историческое">историческое</option>
	<option value="ужасы">ужасы</option>
	<option value="современное">современное</option>
	<option value="многопользовательское">многопользовательское</option>
	<option value="музыкальное">музыкальное</option>
	<option value="мистическое">мистическое</option>
	<option value="старая школа">старая школа</option>
	<option value="платформер">платформер</option>
	<option value="постапокалипсис">постапокалипсис</option>
	<option value="паззл">паззл</option>
	<option value="ролевая">ролевая</option>
	<option value="научное">научное</option>
	<option value="стрелялка">стрелялка</option>
	<option value="вид сбоку">вид сбоку</option>
	<option value="симулятор">симулятор</option>
	<option value="космическое">космическое</option>
	<option value="стимпанк">стимпанк</option>
	<option value="стратегия">стратегия</option>
	<option value="тактика">тактика</option>
	<option value="текстовая">текстовая</option>
	<option value="визуальная новелла">визуальная новелла</option>
	<option value="вестерн">вестерн</option>
</select>



<br /><br />
<input type="submit" name="submit" value="Искать" />
</form>


</div>


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