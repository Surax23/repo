<?php
	$this->load->view('header');
?>
<div class="games"><div id="news">
<h2><?php echo $f_name['name']; ?></h2><br />
<?php
	if ( $this->ion_auth->logged_in() ) {
		echo '<a href="'.base_url().'index.php/forum/newtopic/'.$f_name['id'].'" class="button">Новая тема</a>';
	}
?>
<div id="forum_cat">Темы</div>
<?php
	if ($topics === false) {
		echo '<div id="forum_forum">Нет тем в выбранном форуме.</div>';
	} else {
		foreach ($topics as $topic) {
			echo '<div id="forum_forum"><img valign="center" style="margin-left: 15px; margin-right: 15px;" align="left" src="'.base_url().'/icon/forum/forum_read.png">';
			echo '<a href="'.base_url().'index.php/forum/topic/'.$topic['id'].'">'.$topic['title'].'</a>';
			echo '<br /><font size="1pt">'.$topic['author'].' || '.$topic['time'].' || Ответов: '.$topic['posts'].' || Просмотров: '.$topic['views'].'</font>';
			echo '<div id="forum_inf">';
			echo 'Последнее сообщение:<br /><font size="1pt">'.$topic['last_post_author'].' || '.$topic['last_post_time'].'</font>';
			echo '</div></div>';
		}
	}

?>

<?php echo $pagination; ?>
</div></div>	
<?php
	$this->load->view('footer');
?>