<?php

  /* This file can receive a job file, either as a zip file or a .pov
   * scene, but need to be able to parse it, and find the correct
   * values for the job from the pov.ini file.
   *
   * It is currently hard-coded to create one frame, non-sliced jobs
   * in 1920x1080 pixels.
   *
   * Ideally, starting, stopping and controlling jobs should have its
   * own tab in the navigation, rather than happening on upload.
   *
   */

function generateRandStr($length){ 
  return md5(time());
} 

function isZipExtension($fileName) {
  return in_array(end(explode(".", $fileName)), array("zip", "ZIP", "Zip"));
}

$hi_jobsdir = '/var/www-httpov/htdocs/jobs/';
$hi_uploaddir = '/var/www-httpov/htdocs/interface/uploads/';

require "../../interface_conf.php";

$zName = generateRandStr(5);
$zFile = $zName . ".zip";

$uploadfile = $hi_uploaddir . basename($_FILES['ufile']['name']);

$db["link"] = mysql_connect ( $db["server"], $db["mortal"],
                              $db["mortal_pass"] );

mysql_select_db ( $db["db"], $db["link"] );

if (move_uploaded_file($_FILES['ufile']['tmp_name'], $uploadfile)) {
  $theFileName = $_FILES [ 'ufile' ][ 'name' ];
  $theFileSize = $_FILES [ 'ufile' ][ 'size' ];

  if ( $theFileSize > 999999 ) {
    $theDiv = $theFileSize / 1000000 ; 
    $theFileSize = round ( $theDiv , 1 ). " MB" ; //round($WhatToRound, $DecimalPlaces) 
  } else {
    $theDiv = $theFileSize / 1000 ; 
    $theFileSize = round ( $theDiv , 1 ). " KB" ; //round($WhatToRound, $DecimalPlaces) 
  }

  if (!isZipExtension($uploadfile)) {
    $zip = new ZipArchive();
    $zip->open( $hi_jobsdir . $zFile, ZIPARCHIVE::CREATE );
    $zip->addFromString("pov.ini", "# povray ini file generated by upload.php\n+Iimg.pov\n+W1920\n+H1080\n+KFF2");
    $zip->addFile($uploadfile, "img.pov");
    $zip->close();

    echo "numfiles: " . $zip->numFiles . "\n"; 
    echo "status:" . $zip->getStatusString() . "\n"; 
  } else {
    if (!copy($uploadfile, $hi_jobsdir . $theFileName)) {
      die("failed to copy $uploadfile to $hi_jobsdir$theFileName\n");
    }

    $zName = substr($theFileName, 0, strrpos($theFileName, '.'));
  }

  $sqName = mysql_real_escape_string($zName);

  // TODO: Move job control to a separate tab.

  //$query = "INSERT INTO job(name, frames, sliced, rows, count, issued) VALUES ('$sqName', 1, 0, 1080, 1, UNIX_TIMESTAMP());";
  //$result = mysql_query($query);
?>

<table cellpadding="5" width="100%"> 
<tr> 
<td align="Center" colspan="2"><b>Upload Successful</b></td> 
</tr> 
<tr> 
<td align="right"><b>File Name: </b></td> 
<td align="left"><?php echo $theFileName; ?></td> 
</tr> 
<tr> 
<td align="right"><b>File Size: </b></td> 
<td align="left"><?php echo $theFileSize; ?></td> 
</tr> 
</table>

<?php

/*
$output = shell_exec("ls -alrt ../jobs/");
echo "<pre> $output </pre>" ;

$output = shell_exec("find .. -iname '*.zip'");
echo "<pre> $output </pre>" ;

$output = shell_exec("ls -alrt uploads/");
echo "<pre> $output </pre>" ;
*/

} else { ?>

<table cellpadding="5" width="80%"> 
<tr> 
<td align="Center" colspan="2"><font color=\"#C80000\"><b>File could not be uploaded</b></font></td> 
</tr> 
</table> 
<?php 
}
?>