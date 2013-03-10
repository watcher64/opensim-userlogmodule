<?php
//Developer: Watcher64 (watchersphone [at] gmail.com)
//Function : MODDED PHP Port for OpenSim-userlogmodule
//Source Tree : https://github.com/watcher64/MODDED_php_for_opensim-userlogmodule
//Modified by Watcher64
//Returns regions visists in a table one collum wide
//Added a search box for user
//Added a dropdown to select the number of visits to return , default is 50
//ignore will ignore a certain user
//Example: http://<your web server>/visits.php?last=30&ignore=Ignore%20User
//Also added current online users, this only works if you are using the same DB
//for the visits as for your grid, and your presence table is named "Presence"
?>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	color: #900;
}
body {
	background-color: #000;
	margin-left: 15px;
	margin-top: 15px;
}
</style>
<body bgcolor="#000000" text="#990000">

<p>
  <?php
//connect to the server

include("include/userlogdb.php");


$last = $_GET["last"];
$search= $_GET["search"];
if ($last == 0){ $last=50; }
$ignore = $_GET["ignore"];
if ($ignore == ""){ $ignore=""; }
mysql_connect ($DB_HOST, $DB_USER, $DB_PASSWORD);
mysql_select_db ($DB_NAME);
//query the database
$q1 = 'SELECT * FROM userlog_agent WHERE agent_name ="' . $search .'"';
$q2 = ' ORDER BY count DESC LIMIT '  . $last ;
if ($search ==""){$q1='SELECT * FROM userlog_agent ';}
$query = $q1 . $q2;

//$query = 'SELECT * FROM userlog_agent WHERE agent_name !=' . $ignore'" ORDER BY count DESC LIMIT ' . $last ;

//fetch the results / convert results into an array

$onlinecount = mysql_query("SELECT * FROM Presence");

$finalcount = mysql_num_rows($onlinecount);
$onlineusers ="Users Online Now: " . $finalcount . "<br>";
if ($finalcount == 0){ $onlineusers=""; }

echo "<h1><strong><u>Last $last Region Visits</u></strong></h1>";

//echo "$query";
?>
<form action="" method="<?php echo $PHP_SELF;?>" name="last" target="_self">
  <p>Number of Vists to return: 
    <select name="last">
      <option Value = "10">10</option>
      <option Value = "20">20</option>
      <option Value = "30">30</option>
      <option Value = "40">40</option>
			<option selected Value = "50">50</option>
      <option Value = "60">60</option>
      <option Value = "70">70</option> 
      <option Value = "80">80</option>
      <option Value = "90">90</option>
      <option Value = "100">100</option>
    </select>
  </p>
  <p>
    Search for User:
      <input type="text" name="search">
      <button name="submit" type="submit">Search</button>
</p>
</form>
<?php
echo "$onlineusers";
echo "latest visits first.";
//echo "<br>$query<br>";   
        
        // execute query 
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

// see if any rows were returned 
if (mysql_num_rows($result) > 0) { 
    // yes 
    // print them one after another 
define('COLS', 2); // number of columns
$col = 0; // number of the last column filled
?>
</p>
<p>&nbsp; </p>
<table border="1px" CELLPADDING="6" BORDERCOLOR="383838" width="500px ">
  <tr>
<?php
while ($rows = mysql_fetch_array($result))
{ $col++;
  if ($col == COLS) // have filled the last row
  { $col = 1; 
  	
    echo '</tr><tr>'; // start a new one
    echo '<center>';
  }
  echo '<td> <b><i><u><FONT SIZE=+1 COLOR=#00CC00>', $rows[3], '</b></i></u></FONT> visited <b><FONT COLOR=#FFFF00>', $rows[1],'</b></FONT><br> at <FONT COLOR=#FFFFFF>', $rows[8],'</FONT><br>From IP: ', $rows[5],'<br>Country: ', $rows[6],'<br>Viewer: ', $rows[7], '</center>', '</td>';
 
}
?>
</tr>
</table>
<?php
} 
else { 
    // no 
    // print status message 
    echo "No rows found!"; 
} 

// free result set memory 
mysql_free_result($result); 

// close connection 
mysql_close($connection); 

?>


