<?php
/**
 * Converts current time for given timezone (considering DST)
 *  to 14-digit UTC timestamp (YYYYMMDDHHMMSS)
 *
 * DateTime requires PHP >= 5.2
 *
 * @param $str_user_timezone
 * @param string $str_server_timezone
 * @param string $str_server_dateformat
 * @return string
 */
function now($str_user_timezone,
       $str_server_timezone = CONST_SERVER_TIMEZONE,
       $str_server_dateformat = CONST_SERVER_DATEFORMAT) {
 
  // set timezone to user timezone
  date_default_timezone_set($str_user_timezone);
 
  $date = new DateTime('now');
  $date->setTimezone(new DateTimeZone($str_server_timezone));
  $str_server_now = $date->format($str_server_dateformat);
 
  // return timezone to server default
  date_default_timezone_set($str_server_timezone);
 
  echo "date = ".$date;
}
?>
