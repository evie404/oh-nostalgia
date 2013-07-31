<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>
<?php
echo "Test\n";
$root = $_GET{root};
$offset = $_GET{offset};
$pp = $_GET{pp};
echo '<br />aaa'.$root.'<br>';
echo "<br />";
echo "<br />".$offset.'<br>';
$filename = "123214aaa.jpg";
echo '<br />'.substr($filename,0,-4).'<br>';
echo '<br />'.substr($filename,-3).'<br>';
echo "<br />";
echo "<br />";
if ($handle = opendir($root)) {
    echo "Directory handle:".$handle."<br>";
    echo "Files:".sizeof($handle)."<br>";
	
	if (file_exists($root.'.txt')){
		$fil = fopen($root.'.txt', r);
		$dat = fread($fil, filesize($root.'.txt')); 
		echo $dat+1;
		fclose($fil);
		$fil = fopen($root.'.txt', w);
		fwrite($fil, $dat+1);
	}
	else{
		$fil = fopen($root.'.txt', w);
		fwrite($fil, 1);
		echo '1';
		fclose($fil);
	}
echo "<br />";
$fil = fopen($root.'.txt', w);
    // List all the files
    while (false !== ($file = readdir($handle))) {
		if(substr($file,-3)=="jpg"){
		//echo "<img src=\"GA/$file\"> <br>";
        //echo "<a href=\"GA/$file\">$file</a> <br>";
			fwrite($fil, $file."\n");
		}
    }
fclose($fil);
    closedir($handle);

echo "read file<br />";

	$fil = fopen($root.'.txt', r);
	$count1=1;
	$count2=0;
	if($offset>$pp){
		$offset-=$pp;
		echo "<a href=\"index.php?root=$root&offset=$offset&pp=$pp\">Previous Page</a> <br>";
		$offset+=$pp;
	}
	if ($fil) {
	while (!feof($fil)) // Loop til end of file.
	{
		$file = substr(fgets($fil),0,-1);
		if($count1<$offset){
			$count1++;
		}
		else if($count2<$pp){
			$count2++;
			echo "<a href=\"$root/$file\">$file</a> <br>";
		}else{
			$offset+=$pp;
			echo "<a href=\"index.php?root=$root&offset=$offset&pp=$pp\">Next Page</a> <br>";
			break;
		}
	}
	fclose($fil); // Close the file.
	}
}
?>
<body>
 
</body>
</html>
