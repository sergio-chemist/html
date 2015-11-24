<?php

define('MAIN_TITLE', 'Инструментарий Web-разработчика');
define('PAGE_TITLE', 'Web instruments');

function showHTML5($close=false, $lang="ru") {
if ($close) echo "</html>\n"; else {
echo "<!DOCTYPE html>\n";
echo "<html lang=\"$lang\">\n";
	}
}

function showHeadTag($close) {
if ($close) echo "</head>\n"; else
			echo "<head>\n";
}

function linkCSS($cssFiles) {
$parts=explode(";", $cssFiles);
for ($i=0, $n=count($parts); $i<$n ; $i++) { 
	$value=$parts[$i];
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$value\">\n";
	}
}

function linkJS($jsFiles) {
$parts=explode(";", $jsFiles);
for ($i=0, $n=count($parts); $i<$n ; $i++) { 
	$value=$parts[$i];
	echo "<script type=\"text/javascript\" src=\"$value\"></script>\n";
	}
}

function showBodyTag($close) {
if ($close) echo "</body>\n"; else
			echo "<body>\n";
}

function showMainHead($title, $content) {
	echo "<title>$title</title>\n";
	echo "<meta name=\"pagetype\" content=\"$content\">\n";
	echo "<meta charset=\"UTF-8\">\n";
}

function showHomeButton($visible) {
	if (!$visible) {
 	echo "<style>\n";
 	echo "#home_button {display:none}\n";
	echo "</style>\n";
    }
}

function showMenu() {
	echo "<ul class=\"hmenu\">\n";
	$menu = array("HTML", "CSS", "JS", "PHP", "SQL");
	for ($i=0; $i < count($menu); $i++) { 
	echo 
	sprintf("<li><a href=\"index.php?id=%s\">%s</a></li>\n", strtolower($menu[$i]), $menu[$i]);
	}
	echo "</ul>\n";
}

function showDivider($divType, $divName, $close=false) {
	$divTypes=array("."=>"class", "#"=>"id", "!"=>"");
	if ($divName=="") echo "</div>\n"; else
	if (isset($divTypes[$divType])) {
	$div=$divTypes[$divType];
	if ($div!="") 
	{
	echo "<div $div=\"$divName\">\n"; 
	if ($close) echo "</div>\n";
	}
}
}

function showTextDivider($divType, $divName, $text) {
		$divTypes=array("."=>"class", "#"=>"id", "!"=>"");
		if (isset($divTypes[$divType])) {
		$div=$divTypes[$divType];
		if ($div!="") 
		{
		echo "<div $div=\"$divName\">\n";
		echo "$text</div>\n";
		}
	}
}

function getPageTitle($content) {
	if ($content=="main") return 
		PAGE_TITLE; else
	return strtoupper($content)." - ".PAGE_TITLE;
}

function showPagePart($pagePart) {
$links = array(  
	"topbar"=>"homebtn.html",
	'main'=>"intro.html;home.html",
	'html'=>'html/htm.html', 
	'css'=>'css/css.html', 
	'js'=>'js/js.html', 
	'php'=>'php/php.html',
	'sql'=>'sql/sql.html');
	if (isset($links[$pagePart])) {
		switch ($pagePart) {
			case 'topbar':
		showTextDivider("#", "main-header", MAIN_TITLE);	
		require("timer.html");
		showMenu();
		require($links[$pagePart]);
		break;

		default:
		$parts=explode(";", $links[$pagePart]);
		foreach ($parts as $key => $value) require($value);				# code...
				break;
		}
	}
}

function showMainBody($content) {
showDivider("#", "topbar");
showPagePart("topbar");
showDivider("!", "");
showTextDivider(".", "empty", "");
showDivider("#", "main");
showPagePart($content);
showDivider("!", "");
}

function show_HTML_Page($title, $content, $use_style=true, $use_script=true) {
showHTML5(false);
showHeadTag(false);
showMainHead($title, strtoupper($content));
if ($use_style)
linkCSS("hstyle.css;main.css");
if ($use_script)
linkJS("timer.js;events.js");
showHeadTag(true);
showHomeButton($content!="main");
showBodyTag(false);
showMainBody($content);
showBodyTag(true);
showHTML5(true);
}

if (!isset($_GET["id"])) $content="main"; else
	$content=$_GET["id"];
$title=getPageTitle($content);
if (!isset($title)) $title="Home Page"; 
show_HTML_Page($title, $content);
?>
