<?php
	$this->load->view('header');
?>
<h2>Панель управления</h2>
<div class='games'><div id='news'>
	<?php 
		if (($this->ion_auth->logged_in())&&!($this->ion_auth->is_admin())) {
			echo '<p><a href="news/add">>> Предложить новость</a></p>';
		} else if (($this->ion_auth->logged_in())&&($this->ion_auth->is_admin())) {
			echo '<p><a href="'.base_url().'index.php/news/add">>> Добавить новость</a></p>';
			echo '<p><a href="'.base_url().'index.php/news/app">>> Неутвержденные новости</a></p>';
			echo '<p><a href="'.base_url().'index.php/catalog/notappr">>> Неутвержденные игры</a></p>';
		}
		echo '<hr /><p></p>';
	?>
	<p><a href="<?php echo base_url().'index.php/catalog/add'; ?>">>> Добавить игру</a></p>
	<div>
		<table>
			<tr><th>Игра</th><th>Статус</th><th>Действия</th></tr>
			<?php
				if ($error) {
					echo '<tr><td>Игры отсутствуют</td><td></td><td></td>';
				} else {
					foreach ($games as $game) {
						echo '<tr><td><a href="'.base_url().'index.php/catalog/gamedetails/'.$game['id'].'">'.$game['title'].'</a></td>';
						//echo '<td>'.$game['status'].'</td>';
						if ($game['approved']=='0') {
							echo '<td><font color="red">Ожидает одобрения</font></td>';
						} else {
							echo '<td><font color="green">Одобрено</font></td>';
						}
						echo '<td><a href="'.base_url().'index.php/catalog/edit/'.$game['id'].'"><img height="16" title="Редактировать" alt="Редактировать" src="'.base_url().'icon/pencil.png"></a> ';
						echo '<a href="'.base_url().'index.php/catalog/upload/'.$game['id'].'"><img height="16" title="Загрузить файл" alt="Загрузить файл" src="'.base_url().'icon/download.png"></a> ';
						echo '<a href="'.base_url().'index.php/catalog/upload_images/'.$game['id'].'"><img height="16" title="Загрузить скриншоты" alt="Загрузить скриншоты" src="'.base_url().'icon/image.png"></a> ';
						echo ' <a href="'.base_url().'index.php/catalog/delete/'.$game['id'].'" onClick="return window.confirm(\'Вы действительно хотите удалить запись об игре и связанные с ней файлы?\')"><img height="16" title="Удалить" alt="Удалить" src="'.base_url().'icon/delete.png"></a></td></tr>';
					}
				}
			?>
			
		</table>
	</div>
</div></div>	
<?php
	$this->load->view('footer');
?>