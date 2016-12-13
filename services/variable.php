<?php
$today = date("Y-m-d");
$today_time = new DateTime($today);
$GLOBALS['KEY'] = "userSied".$today_time->format('Y-m-d');
//echo "userSied".$today_time->format('Y-m-d');