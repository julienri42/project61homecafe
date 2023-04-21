<?php 
  $time=date("Y-m-d H:i:s",time());
  echo $time."<br>";
  $next=date("Y-m-d H:i:s",strtotime('+3 day'));
  echo $next;
?>