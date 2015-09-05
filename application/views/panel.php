<?php
	$this->load->view('header');
?>
<h2>Панель управления</h2>
<div class='games'><div id='news'>
	<?php 
		if ($this->ion_auth->is_admin()) {
			echo '<p><a href="#">>> Добавить новость</a></p>';
			echo '<hr /><p></p>';
		}
	?>
	<p><a href="#">>> Добавить игру</a></p>
	<div>
		<table>
			<tr><td>Игра</td><td>Статус</td><td>Действия</td></tr>
			<tr><td>Test</td><td>Test</td><td>Test</td></tr>
		</table>
	</div>
</div></div>	
<?php
	$this->load->view('footer');
?>