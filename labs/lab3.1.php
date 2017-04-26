<?php 
function my_calendar($m, $y) { 
  $month_names=array("январь","февраль","март","апрель","май","июнь",
  "июль","август","сентябрь","октябрь","ноябрь","декабрь"); 
  if (!isset($y) || $y < 1970 || $y > 2037) $y=date("Y");
  if (!isset($m) || $m < 1 || $m > 12) $m=date("m");

  $month_stamp=mktime(0,0,0,$m,1,$y);
  $day_count=date("t",$month_stamp);
  $weekday=date("w",$month_stamp);
  if ($weekday==0) $weekday=7;

  $start=-($weekday-2);
  $last=($day_count+$weekday-1) % 7;
  if ($last==0) $end=$day_count; else $end=$day_count+7-$last;
  
  $i=0;
  $result = "<table border=1 cellspacing=0 cellpadding=2 > 
 <tr>
   <td colspan=7 align='center'>" . $month_names[$m-1] . "</td>
 </tr> 
 <tr><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td><tr>";
  for($d=$start;($d<=$end) || ($i < 42);$d++) { 
    if (!($i++ % 7)) $result .= " <tr>\n";
    $result .= '  <td align="center">';
    if ($d < 1 || $d > $day_count) {
      $result .= "&nbsp";
    } else {
      $result .= $d;
    } 
    $result .= "</td>\n";
    if (!($i % 7))  $result .= " </tr>\n";
  }
$result .= "</table>";
return $result;
}


$y = isset($_POST['year']) ? $_POST['year'] : date("Y");

echo "<form method='post'>
	<input type='number' name='year' value=" . htmlspecialchars($y) . ">
	<input type='submit' value='Показать'>
</form>
<h1>" . $y . "</h1>
<table><tr>";
for ($m=1; $m < 13; $m++) { 
	echo "<td>" . my_calendar($m, $y) . "</td>";
	if($m%6 == 0)
		echo "</tr><tr>";
}
echo "</tr></table>";