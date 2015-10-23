<?php
	$this->load->view('header');
?>
<h2>Форум</h2>
<div class="games"><div id="news">

<?php
	//print_r($cats);
	foreach ($cats as $cat) {
		echo '<div id="forum_cat"><h3>'.$cat['name'].'</h3></div>';
		foreach ($forums as $forum) {
			if ($forum['cat_id'] === $cat['id']) {
				echo '<div id="forum_forum"><img valign="center" style="margin-left: 15px; margin-right: 15px;" align="left" src="'.base_url().'/icon/forum/forum_read.png"><h3 style="font-size:12.5pt;">';
				echo '<a href="'.base_url().'index.php/forum/view/'.$forum['id'].'">'.$forum['name'].'</a></h3>';
				echo '<font size="1pt">Тем: ';
				if (!$forum['topic_num']==null) {
					echo $forum['topic_num'].', ';
				} else {
					echo '0, ';
				}
				echo 'Сообщений: ';
				if (!$forum['post_num']==null) {
					echo $forum['post_num'],'</font>';
				} else {
					echo '0</font>';
				}
				echo '<div id="forum_inf">';
				if (!$forum['last_post_subj']==null) {
					if (iconv_strlen($forum['last_post_subj'], 'UTF-8')<=36) {
						echo $forum['last_post_subj'].'<br />';
					} else {
						echo iconv_substr($forum['last_post_subj'], 0, 36, 'UTF-8').'...<br />';
					}
					echo '<font size="1pt">'.$forum['last_post_author'].' || '.$forum['last_post_time'].'</font>';
				} else {
					echo 'Новых сообщений нет.';
				}
				echo '</div></div>';
			}
		}
		echo '<br />';
	}

?>


<!-- <div id="forum_cat"><h3>Категория</h3></div>
<div id="forum_forum"><img valign="center" style="margin-right: 15px;" align="left" src="<?php //base_url(); ?>/icon/forum/forum_read.png"><h3 style="font-size:12.5pt; margin-bottom: -8px;">Форум</h3>Тем: бла, Сообщений: бла<div id="forum_inf">Бла-бла<br>Бла-бла<br>Бла-бла</div></div>
<br> -->

</div></div>	
<?php
	$this->load->view('footer');
?>