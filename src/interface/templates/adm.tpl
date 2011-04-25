{include file="header.tpl"}

{literal}
<script type="text/javascript" src="/jq.min.js"></script>
<script type="text/javascript" src="/jquery.tablesorter.js"></script> 
<!-- script type="text/javascript" src="/jquery.select.js"></script --> 
<script language="javascript" type="text/javascript">
<!-- 

function updateData() {
{/literal}
{if $page eq "job"}
{literal}
  s = document.getElementById('status').value;
  $.ajax({
    type: "GET", url: "adm-job.php", data: "status=" + s,
    beforeSend: function() {
      $("#noticeDiv").html("<img src='themes/blue/ajax-loading.gif' border='0'/>");
    },
    success: function(msg) {
      $("#noticeDiv").html("");
      document.getElementById('myDiv').innerHTML = msg;

      $(".tablesorter tr").mouseover(function() {
        $(this).addClass("over");
      }).mouseout(function() {
          $(this).removeClass("over");
      });

      $('.tablesorter tr:odd').addClass('odd');

      $("#jobTable").tablesorter({ 
        sortList: [[0,1],[1,1],[2,1]] 
      });
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      $("#noticeDiv").html('Error while contacting server. Please try again in a few seconds.');
    }
  });
{/literal}
{elseif $page eq "dashboard"}
{literal}
  s = document.getElementById('status').value;
  $.ajax({
    type: "GET", url: "adm-dash.php", data: "status=" + s,
    beforeSend: function() {
      $("#noticeDiv").html("<img src='themes/blue/ajax-loading.gif' border='0'/>");
    },
    success: function(msg) {
      $("#noticeDiv").html("");

      document.getElementById('myDiv').innerHTML = msg;

      $(".tablesorter tr").mouseover(function() {
        $(this).addClass("over");
      }).mouseout(function() {
          $(this).removeClass("over");
      });

      $('.tablesorter tr:odd').addClass('odd');

      $("#trackTable").tablesorter({ 
        sortList: [[0,0]] 
      });
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      $("#noticeDiv").html('Error while contacting server. Please try again in a few seconds.');
    }
  });
{/literal}
{elseif $page eq "track"}
{literal}
  s = document.getElementById('status').value;
  $.ajax({
    type: "GET", url: "adm-track.php", data: "status=" + s,
    beforeSend: function() {
      $("#noticeDiv").html("<img src='themes/blue/ajax-loading.gif' border='0'/>");
    },
    success: function(msg) {
      $("#noticeDiv").html("");

      document.getElementById('myDiv').innerHTML = msg;

      $(".tablesorter tr").mouseover(function() {
        $(this).addClass("over");
      }).mouseout(function() {
          $(this).removeClass("over");
      });

      $('.tablesorter tr:odd').addClass('odd');

      $("#trackTable").tablesorter({ 
        sortList: [[0,0]] 
      });
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      $("#noticeDiv").html('Error while contacting server. Please try again in a few seconds.');
    }
  });
{/literal}
{elseif $page eq "batch"}
{literal}
  s = document.getElementById('status').value;
  $.ajax({
    type: "GET", url: "adm-batch.php", data: "status=" + s,
    beforeSend: function() {
      $("#noticeDiv").html("<img src='themes/blue/ajax-loading.gif' border='0'/>");
    },
    success: function(msg) {
      $("#noticeDiv").html("");

      document.getElementById('myDiv').innerHTML = msg;

      $(".tablesorter tr").mouseover(function() {
        $(this).addClass("over");
      }).mouseout(function() {
          $(this).removeClass("over");
      });

      $('.tablesorter tr:odd').addClass('odd');

      $("#batchTable").tablesorter({ 
        sortList: [[0,1]] 
      });
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      $("#noticeDiv").html('Error while contacting server. Please try again in a few seconds.');
    }
  });
{/literal}
{elseif $page eq "upload"}
{literal}
  s = document.getElementById('status').value;
  $.ajax({
    type: "GET", url: "adm-upload.php", data: "status=" + s,
    beforeSend: function() {
      $("#noticeDiv").html("<img src='themes/blue/ajax-loading.gif' border='0'/>");
    },
    success: function(msg) {
      $("#noticeDiv").html("");

      document.getElementById('myDiv').innerHTML = msg;

    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      $("#noticeDiv").html('Error while contacting server. Please try again in a few seconds.');
    }
  });
{/literal}
{/if}
{literal}
}

$(function() {
});

$(document).ready(function() { 
  updateData();
});

//-->
</script>

<link rel="stylesheet" href="themes/blue/style.css" type="text/css" id="" media="print, projection, screen" />
{/literal}

<body>
<table border=0 cellpadding="4" width="100%" bgcolor="#8dbdd8"><tr>
<td align="left">
{if $page eq "dashboard"}<b>{/if} <a href="{$SCRIPT_NAME}?data=dashboard">dashboard</a> {if $page eq "dashboard"}</b>{/if}
|
{if $page eq "job"}<b>{/if} <a href="{$SCRIPT_NAME}?data=job">job</a> {if $page eq "job"}</b>{/if}
|
{if $page eq "batch"}<b>{/if} <a href="{$SCRIPT_NAME}?data=batch">batch</a> {if $page eq "batch"}</b>{/if}
|
{if $page eq "track"}<b>{/if} <a href="{$SCRIPT_NAME}?data=track">track</a> {if $page eq "track"}</b>{/if}
|
{if $page eq "upload"}<b>{/if} <a href="{$SCRIPT_NAME}?data=upload">upload</a> {if $page eq "upload"}</b>{/if}
</td>
<td align="right">
<table border=0><tr><td valign="center" id="noticeDiv"><img src="themes/blue/ajax-loading.gif" border="0"/></td><td>
 <form id="myForm" name="myForm" method="get">show
  <select id="status" name="status" onChange="updateData();">
   {html_options values=$status_names output=$status_names selected=$statussel}
  </select>
  <input type="submit" value="Refresh" onClick="updateData(); return false;">
 </form>
</td></tr></table>
</td>
</tr>
</table>

<p>
<div id="myDiv"/>
</p>

{include file="footer.tpl"}
