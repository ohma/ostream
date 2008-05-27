<html>
<head>
<title>Ostream</title>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<link rel="stylesheet" href="/default.css" type="text/css">
</head>
<body>
<h3>Ostream - ustream viewer -</h3>

<?php
// Configurarion
$php_self = "index.php";
$filename="./data.dat";
$default_width = 150;
$default_col = 3;

// Draw Ustream Function
function draw_ustream ($num,$width,$name) {
$height = $width * 0.8;
echo "<td class=\"whitebg\">";
echo "<embed flashvars=\"autoplay=false&amp;brand=embed\" width=\"$width\" height=\"$height\" allowfullscreen=\"true\" src=\"http://www.ustream.tv/flash/live/$num\" type=\"application/x-shockwave-flash\" /><center><a href=\"http://www.ustream.tv/channel/$name\" target=\"_blank\">$name</center>";
echo "</td>\n";
}

// Read parameter
function set_parameter ($param,$def_param) {
   if((isset($param)) && (preg_match("/^[0-9]+$/",$param))) {
   $out = $param;
   } else {
   $out = $def_param;
   }
   return $out;
}

$width = set_parameter($_GET['width'],$default_width);
$col = set_parameter($_GET['col'],$default_col);


// Parameter Forms
echo "<form action=$php_self method=\"GET\" enctype=application/x-www-form-urlencoded>\n";
echo " width <input type=text name=width size=5 value=$width>\n";
echo " column <input type=text name=col size=5 value=$col>\n";
echo " <input type=submit value=\"Set Parameter\">\n";
echo "</form>\n";


// Main function
echo "current parameter width:$width col:$col<br>\n";
echo "<table class=\"zero\">\n<tr>\n";
$col_count = 1;
$handle = fopen("$filename","r+");
while (($data = fgetcsv($handle)) !== FALSE) {
   draw_ustream($data[1],$width,$data[0]);
   if ($col_count == $col) {
   echo "</tr>\n<tr>";
   $col_count = 1;
   }
   else {
   $col_count++;
   }
}
echo "</table>";
fclose($handle);
?>

</body>
</html>
