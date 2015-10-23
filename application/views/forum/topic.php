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
		echo '<div id="forum_mtopic"><div id="forum_topic">Тема: '.$topic['title'].' || Дата: '.$post['time'].'</div>';
		echo '<div id="forum_author"><b>'.$post['author'].'</b></div>';
		echo '<div id="forum_post">'.$post['text'].'<div style="clear:both;"></div></div></div><br />';
	}
?>
</div></div>	
<?php
	$this->load->view('footer');
?>