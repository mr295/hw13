<?php
  
  include_once('curl.php');
  
  $c = new CURL();

  echo $c->httpGet("https://web.njit.edu/~mr295/hw13/main.php");

?>