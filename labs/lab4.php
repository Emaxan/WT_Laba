<?php
echo '<textarea style="width:100%;height:50%;" form="TA" name="text" placeholder="text"/>'.(isset($_POST['text']) ? $_POST['text'] : 'text 123 number 8004846 
800-48-46 
+375(29)8004846 
80298004846 
8 017 345-01-47 
+79261234567 
89261234567 
79261234567 
+7 926 123 45 67 
8(926)123-45-67 
123-45-67 
9261234567 
79261234567 
(495)1234567 
(495) 123 45 67 
89261234567 
8-926-123-45-67 
8 927 1234 234 
8 927 12 12 888 
8 927 12 555 12 
8 927 123 8 123 
текст с номерами телефонов 89163325543, +79162341123, и вот так еще +7(916)2344433, нет это не реклама мтс 926 112 44 33, и не мегафона (926)123-22-11 и еще можно так 495 444-55-55').'</textarea>';
echo '<form method="post" style="width:100%;text-align:center;" id="TA"><input type="submit"></form>';

if(isset($_POST['text'])){
	$text = preg_replace("/\n/", "<br/>", $_POST['text']);
	$text = preg_replace("/(\s?\+?(\d|\d{3})[\- ]?)?(\(?\d{2,3}\)?[\- ]?)?([\d\- ]{7,10})/","<span style='color:green;'>$0</span>",$text);
	$text = preg_replace("/(\s?\+(\d|\d{3})[\- ]?)(\(?\d{2,3}\)?[\- ]?)?([\d\- ]{7,10})/","<span style='text-decoration: underline;'>$0</span>",$text);
	echo $text;
}