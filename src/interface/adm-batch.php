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

  if ($status == "running") {
    $sql = "select *, unix_timestamp(now())-issued as time, from_unixtime(issued) AS issued from batch where finished = 0 and aborted = 0 and unix_timestamp(now())-issued < 2000 order by id desc";
  } else if ($status == "finished") {
    $sql = "select *, finished-issued as time, from_unixtime(issued) AS issued from batch where finished != 0 order by id desc";
  } else if ($status == "aborted") {
    $sql = "select *, aborted-issued as time, from_unixtime(issued) AS issued from batch where aborted != 0 order by id desc";
  } else if ($status == "all") {
    $sql = "select *, finished-issued as time, from_unixtime(issued) AS issued from batch order by id desc";
  } else {
    $sql = "select *, finished-issued as time, from_unixtime(issued) AS issued from batch order by id desc";
  }

  $sql .=" limit 250";

  $result = mysql_query($sql) or die ("Error in query: $sql. " . mysql_error());

  while ($row = mysql_fetch_object($result)) {
    if ($row->time < 0) {
      $row->time = "";
    }

    $results[] = $row;
  }

  $smarty->assign('results',$results);
  $smarty->display('adm-batch.tpl');

  mysql_close($db["link"]);
?>
