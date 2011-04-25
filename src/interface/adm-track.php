<?php
  include "../../interface_conf.php";

  require_once(SMARTY_DIR . 'Smarty.class.php');

  $db["link"] = mysql_connect ( $db["server"], $db["mortal"],
                                $db["mortal_pass"] ) or die ("Unable to connect!");

  mysql_select_db ( $db["db"], $db["link"] ) or die ("Unable to select database!");

  $smarty = new Smarty();
  $smarty->template_dir = './templates/';
  $smarty->compile_dir = './templates/compile/';
  $smarty->cache_dir = './templates/cache/';
  $smarty->caching = 0; // Disable caching of pages
  $smarty->error_reporting = E_ALL; // LEAVE E_ALL DURING DEVELOPMENT
  $smarty->debugging = false;

  $status = mysql_real_escape_string($_GET['status']);

  if ($status == "all") {
    $sql = "select *, unix_timestamp(now())-unix_timestamp(tm) AS time from track order by time asc";
  } else if ($status == "active") {
    $sql = "select *, unix_timestamp(now())-unix_timestamp(tm) AS time from track where unix_timestamp(now())-unix_timestamp(tm) < 600 order by time asc";
  } else if ($status == "sleeping") {
    $sql = "select *, unix_timestamp(now())-unix_timestamp(tm) AS time from track where unix_timestamp(now())-unix_timestamp(tm) < 600 and cmd = 'sleep' order by time asc";
  } else if ($status == "abortbatch") {
    $sql = "select *, unix_timestamp(now())-unix_timestamp(tm) AS time from track where cmd = 'abortbatch' order by time asc";
  }

  $sql .=" limit 250";

  $result = mysql_query($sql) or die ("Error in query: $sql. " . mysql_error());

  while ($row = mysql_fetch_object($result)) {
    $results[] = $row;
  }

  $smarty->assign('results',$results);
  $smarty->display('adm-track.tpl');

  mysql_close($db["link"]);
?>
