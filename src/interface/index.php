<?php
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

  include "../../interface_conf.php";

  require_once(SMARTY_DIR . 'Smarty.class.php');

  $smarty = new Smarty();
  $smarty->template_dir = './templates/';
  $smarty->compile_dir = './templates/compile/';
  $smarty->cache_dir = './templates/cache/';
  $smarty->caching = 0; // caching of pages 0 == disable
  $smarty->error_reporting = E_ALL; // LEAVE E_ALL DURING DEVELOPMENT
  $smarty->debugging = false;

  $data = $_GET['data'];

  if ($data == "dashboard" || $data == "") {
    $statussel = $_GET['status'];

    $smarty->assign('status_names', array('full', 'compact'));
    $smarty->assign('statussel', $statussel);

    $smarty->assign('title', 'Dashboard');
    $smarty->assign('page', 'dashboard');
    $smarty->display('adm.tpl');
  } else if ($data == "job" || $data == "") {
    $statussel = $_GET['status'];

    $smarty->assign('status_names', array('all', 'waiting', 'running', 'finished', 'aborted', 'locked'));
    $smarty->assign('statussel', $statussel);

    $smarty->assign('title', 'Job');
    $smarty->assign('page', 'job');
    $smarty->display('adm.tpl');
  } else if ($data == "track") {
    $smarty->assign('status_names', array('active', 'sleeping', 'abortbatch', 'all'));
    $smarty->assign('statussel', $statussel);

    $smarty->assign('title', 'Track');
    $smarty->assign('page', 'track');
    $smarty->display('adm.tpl');
  } else if ($data == "batch") {
    $statussel = $_GET['status'];

    $smarty->assign('status_names', array('running', 'finished', 'aborted', 'all'));
    $smarty->assign('statussel', $statussel);

    $smarty->assign('title', 'batch');
    $smarty->assign('page', 'batch');
    $smarty->display('adm.tpl');
  } else if ($data == "upload") {

    $smarty->assign('prio_names', array('1', '2', '3'));
    $smarty->assign('priosel', "2");

    $smarty->assign('title', 'Upload');
    $smarty->assign('page', 'upload');
    $smarty->display('adm.tpl');
  }
?>
