<?php
echo '<style>tr{text-align:center;height: 20px;}table{width:100%}</style>';
echo '<table>';
$n=0;$r=250;$g=250;$b=250;
for(; $r>0; $r-=2)   echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
for(; $g>0; $g-=2)   echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
for(; $r<250; $r+=2) echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
for(; $b>0; $b-=2)   echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
for(; $g<250; $g+=2) echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
for(; $r>0; $r-=2)   echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
for(; $b<250; $b+=2) echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
for(; $r<250; $r+=2) echo '<tr style="background-color: rgb('.$r.','.$g.','.$b.');"><td>'.$n++.' - ('.$r.','.$g.','.$b.')'.'</td></tr>';
echo '</table>';