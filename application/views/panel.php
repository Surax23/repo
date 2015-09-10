<?php
	$this->load->view('header');
?>
<h2>Панель управления</h2>
<div class='games'><div id='news'>
	<?php 
		if (($this->ion_auth->logged_in())&&!($this->ion_auth->is_admin())) {
			echo '<p><a href="news/add">>> Добавить новость</a></p>';
		} else if (($this->ion_auth->logged_in())&&($this->ion_auth->is_admin())) {
			echo '<p><a href="news/add">>> Добавить новость</a></p>';
			echo '<p><a href="news/app">>> Неутвержденные новости</a></p>';
			//echo '<p><a href="#">>> Добавить игру другого автора</a></p>';
		}
		echo '<hr /><p></p>';
	?>
	<p><a href="#">>> Добавить игру</a></p>
	<div>
		<table>
			<tr><th>Игра</th><th>Статус</th><th>Действия</th></tr>
			<tr>
			<?php
				if ($error) {
					echo '<td>Игры отсутствуют</td><td></td><td></td>';
				} else {
					foreach ($games as $game) {
						echo '<td>'.$game['title'].'</td>';
						echo '<td>'.$game['status'].'</td>';
						echo '<td><img height="16" alt="Редактировать" src="'.base_url().'icon/pencil.png"> <img height="16" alt="Удалить" src="'.base_url().'icon/delete.png"></td>';
					}
				}
			?>
			</tr>
		</table>
	</div>
</div></div>	
<?php
	$this->load->view('footer');
?>