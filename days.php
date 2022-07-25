<?php

$row = '';
$startDate = '12/30/2018';
$numDays = 35;
$datesArr = array();
$weekCounter = 1;

for ($i = 0; $i <= $numDays; $i++) {

    $date = date('m/j/Y', strtotime("$startDate +$i days"));
    $datesArr[] = $date;

    // New div at start of week
    if (date("l", strtotime($date)) == "Sunday") {
        $row .= "<div style=\"float: left; margin: 10px;\">";
        $row .= '<p>Week ' . $weekCounter++ . '</p>';
    }

    $row .= '<p>'. $date . ' - ' . date("l", strtotime($date)) . '</p>';

    // close div at end of week
    if (date("l", strtotime($date)) == "Saturday") {
        $row .= "</div>"; 
    }

}
https://armadiomenswear.com/
echo $row;

?>