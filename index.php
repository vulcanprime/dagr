<?php

$ggroup = $_GET["ggroup"];
$sstart = $_GET["sstart"];

require ($ggroup."head.php");

//set the variables of the database
$Host = "localhost";
$User = "dagr";
$Password = "somethingsecure";
$DBName = "dagr";
$TableName = "appt";
$Link = mysql_connect ($Host, $User, $Password);
mysql_select_db($DBName);

    print ("<tr>");

//$ggroup = "bio";


//sstart must be a monday
//$sstart = "20020819";
//    print ("hi hi $sstart<br>");

$yyear = substr($sstart,0,4);
$mmonth = substr($sstart,4,2);
$argday = substr($sstart,6,2);

for ($i=0; $i<=25;$i++) {

  $ghday = mktime(0,0,0,$mmonth,$i+$argday,$yyear);
  $hgday = date("F j", $ghday);
  if ( date("w", $ghday) == "0" ) continue ;
  if ( date("w", $ghday) == "6" ) continue ;
  if ( date("w", $ghday) == "1" ) {
    print ("</tr><tr>\n");

  }
  $Query = "SELECT Advisor FROM appt WHERE Day = \"$ghday\" and Agroup = \"$ggroup\" GROUP BY Advisor";
  $Result = mysql_query ($Query, $Link) or die(mysql_error());
//  $Result = mysql_query ($DBName, $Query, $Link);
    print ("<td>");
    print ("$hgday<br>");

  while ($Row = mysql_fetch_array ($Result)) {
    $encadv=urlencode($Row[Advisor]);
    print ("<a href=\"show.php?aadvisor=$encadv&dday=$ghday&ggroup=$ggroup&sstart=$sstart\">$Row[Advisor]</a></br>\n");



  }
    print ("</td>");
}

    print ("</tr>");

//$Query = "SELECT Advisor, Day FROM appt GROUP BY Advisor, Day";
//  print ("$Query\n");

//$Result = mysql_query ($DBName, $Query, $Link);

//$cdate = date ("l F j, Y", $dday);
//print ("<h1>$aadvisor</h1>Appointment times for $cdate<br>");
//print ("<table border=1>");

//fetch results from the database
//  print ("<tr>");
//  print ("<td>&nbsp;</td>\n");
//  print ("<td>Time</td>\n");
//  print ("<td>Student</td>\n");
//  print ("</tr>\n");

//while ($Row = mysql_fetch_array ($Result)) {
//  print ("<tr>");
//  $encadv=urlencode($Row[Advisor]);
//  print ("<td><a href=\"show.php?aadvisor=$encadv&dday=$Row[Day]\">View</a></td>\n");
//  $cdate = date ("l F j, Y", $Row[Day]);
//  print ("<td>$cdate</td>\n");
//  print ("<td>$Row[Advisor]</td>\n");
//  print ("</tr>\n");
//}

mysql_close ($Link);

print ("</table>");
require ("indfoot.php");

?>
