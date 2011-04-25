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

  // clients
  $sql_c_all = "select count(*) as c from track where unix_timestamp(now())-unix_timestamp(tm) < 6000 and cmd != 'abortbatch' and cmd != 'abort'";
  $res_c_all = mysql_query($sql_c_all) or die ("Error in query: $sql_c_all " . mysql_error());
  while ($row_c_a = mysql_fetch_object($res_c_all)) { $res_c_a[] = $row_c_a; }
  $smarty->assign('res_c_a',$res_c_a);

  $sql_c_sleep = "select count(*) as c from track where unix_timestamp(now())-unix_timestamp(tm) < 6000 and cmd = 'sleep'";
  $res_c_sleep = mysql_query($sql_c_sleep) or die ("Error in query: $sql_c_sleep " . mysql_error());
  while ($row_c_s = mysql_fetch_object($res_c_sleep)) { $res_c_s[] = $row_c_s; }
  $smarty->assign('res_c_s',$res_c_s);

  $sql_c_running = "select count(*) as c from track where unix_timestamp(now())-unix_timestamp(tm) < 6000 and cmd = 'getbatch' or cmd = 'getjob' or cmd = 'postbatch'";
  $res_c_running = mysql_query($sql_c_running) or die ("Error in query: $sql_c_running " . mysql_error());
  while ($row_c_r = mysql_fetch_object($res_c_running)) { $res_c_r[] = $row_c_r; }
  $smarty->assign('res_c_r',$res_c_r);

  // jobs
  $sql_all = "select count(*) as jobs from job;";
  $res_all = mysql_query($sql_all) or die ("Error in query: $sql_all " . mysql_error());
  while ($row_a = mysql_fetch_object($res_all)) { $res_a[] = $row_a; }
  $smarty->assign('res_a',$res_a);

  $sql_queued = "select count(*) as jobs from job where current = 0 and finished = 0 and aborted = 0;";
  $res_queued = mysql_query($sql_queued) or die ("Error in query: $sql_queued " . mysql_error());
  while ($row_q = mysql_fetch_object($res_queued)) { $res_q[] = $row_q; }
  $smarty->assign('res_q',$res_q);

  $sql_running = "select count(*) as jobs from job where finished = 0 and current != 0 and aborted = 0;";
  $res_running = mysql_query($sql_running) or die ("Error in query: $sql_running " . mysql_error());
  while ($row_r = mysql_fetch_object($res_running)) { $res_r[] = $row_r; }
  $smarty->assign('res_r',$res_r);

  $sql_finished = "select count(*) as jobs from job where finished != 0;";
  $res_finished = mysql_query($sql_finished) or die ("Error in query: $sql_finished " . mysql_error());
  while ($row_f = mysql_fetch_object($res_finished)) { $res_f[] = $row_f; }
  $smarty->assign('res_f',$res_f);

  $smarty->display('adm-dashboard.tpl');

  mysql_close($db["link"]);
?>
