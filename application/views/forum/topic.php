<?php
	$this->load->view('header');
?>
<div class="games"><div id="news">
<h3>Тема: <?php echo $topic['title']; ?></h3><br />
<?php 
	if ( $this->ion_auth->logged_in() ) {
		echo '<a class="button" href="'.base_url().'index.php/forum/reply/'.$topic['id'].'">Ответить</a>';
	}
	foreach ($posts as $post) {
		echo '<div id="forum_mtopic"><div id="forum_topic">Тема: '.$topic['title'].' || Дата: '.$post['time'];
		$user = $this->ion_auth->user()->row();
		if ($this->ion_auth->is_admin() || $post['author']==$user->username) {
			echo ' || <a href="'.base_url().'index.php/forum/edit/'.$post['id'].'"><img height="16" title="Редактировать" alt="Редактировать" src="'.base_url().'icon/pencil.png"></a>';
		}
		echo '</div>';
		echo '<div id="forum_author"><b>'.$post['author'].'</b><br />';
		if (!$post['last_updated']==null) {
			echo '<font size="1pt">Последнее обновление: '.$post['last_updated'].'</font>';
		}
		echo '</div>';
		echo '<div id="forum_post">'.$post['text'].'<div style="clear:both;"></div></div></div><br />';
	}
	echo $pagination;
?>
</div></div>	
<?php
	$this->load->view('footer');
?>