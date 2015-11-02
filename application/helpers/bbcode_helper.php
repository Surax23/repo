<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('bbcodes')) {
	function bbcodes($text) {
		$text = htmlspecialchars($text);
		$find = array(
			'~\[b\](.*?)\[/b\]~s',
			'~\[i\](.*?)\[/i\]~s',
			'~\[u\](.*?)\[/u\]~s',
			'~\[s\](.*?)\[/s\]~s',
			'~\[quote\](.*?)\[/quote\]~s',
			'~\[code\](.*?)\[/code\]~s',
			'~\[size=(.*?)\](.*?)\[/size\]~s',
			'~\[color=(.*?)\](.*?)\[/color\]~s',
			'#\[[\s]*url[\s]*=[\s]*([^\]]*)\]([^\[]*)\[[\s]*/url[s]*\]#i',
			'~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
		);
		$replace = array(
			'<b>$1</b>',
			'<i>$1</i>',
			'<u>$1</u>',
			'<s>$1</s>',
			'<blockquote>$1</blockquote>',
			'<code>$1</code>',
			'<span style="font-size:$1px;">$2</span>',
			'<span style="color:$1;">$2</span>',
			'<a href=\\1>\\2</a>',
			'<img src="$1" alt="" />'
		);
		$text = preg_replace($find,$replace,$text);
		return $text = nl2br($text, true);
	}
}
	
if (! function_exists('transliterate')) {
	function transliterate($st) { 
		$transsimvol = array(
		'А'=>'A','Б'=>'B','В'=>'V','Г'=>'G', 
		'Д'=>'D','Е'=>'E','Ж'=>'Zh','З'=>'Z','И'=>'I', 
		'Й'=>'Y','К'=>'K','Л'=>'L','М'=>'M','Н'=>'N', 
		'О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T', 
		'У'=>'U','Ф'=>'F','Х'=>'H','Ц'=>'Ts','Ч'=>'Ch', 
		'Ш'=>'Sh','Щ'=>'Sch','Ъ'=>'','Ы'=>'Y','Ь'=>'', 
		'Э'=>'E','Ю'=>'Yu','Я'=>'Ya', 
		
		'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d', 
		'е'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y', 
		'к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o', 
		'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u', 
		'ф'=>'f','х'=>'h','ц'=>'ts','ч'=>'ch','ш'=>'sh', 
		'щ'=>'sch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e', 
		'ю'=>'yu','я'=>'ya' 
		); 
		return strtr($st,$transsimvol); 
	}  
}