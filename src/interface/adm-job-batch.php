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
    $sql = "select job.id, job.name, job.prio, client, job.finished-job.issued as time, from_unixtime(batch.issued) AS issued from job, batch where job.id = batch.job and batch.issued != 0 and batch.aborted = 0 order by batch.issued desc limit 500";
#    $sql = "select job.id, job.name, client, job.issued from job, batch where job.id = batch.job and batch.issued != 0 and job.finished = 0 order by job.id asc";
#    $sql = "select *, finished-issued as time, from_unixtime(issued) AS issued  from job where finished = 0 and current != 0 order by id desc";
  }

  $result = mysql_query($sql) or die ("Error in query: $sql. " . mysql_error());

  while ($row = mysql_fetch_object($result)) {
    if ($row->time < 0) {
      $row->time = "..";
    }

    $results[] = $row;
  }

  $smarty->assign('results',$results);
  $smarty->display('adm-job-batch.tpl');

  mysql_close($db["link"]);
?>
