<body bgcolor="#000000" text="#990000">
<?php
//Developer: Watcher64 (watchersphone [at] gmail.com)
//Function : MODDED PHP Port for OpenSim-userlogmodule
//Source Tree : https://github.com/watcher64/MODDED_php_for_opensim-userlogmodule
//Modified by Watcher64
//Returns regions visists in a table one collum wide
//Now will pass two get variables
//last and ignore
//last will determine how many visits to return.
//ignore will ignore a certain user
//Example: http://<your web server>/visits.php?last=30&ignore=Ignore%20User
//Also added current online users, this only works if you are using the same DB
//for the visits as for your grid, and your presence table is named "Presence"



//connect to the server

include("include/userlogdb.php");


$last = $_GET["last"];

if ($last == 0){ $last=50; }
$ignore = $_GET["ignore"];
if ($ignore == ""){ $ignore=""; }
mysql_connect ($DB_HOST, $DB_USER, $DB_PASSWORD);
mysql_select_db ($DB_NAME);
//query the database
$q1 = 'SELECT * FROM userlog_agent WHERE agent_name !="' . $ignore .'"';
$q2 = ' ORDER BY count DESC LIMIT '  . $last ;
$query = $q1 . $q2;

//$query = 'SELECT * FROM userlog_agent WHERE agent_name !=' . $ignore'" ORDER BY count DESC LIMIT ' . $last ;

//fetch the results / convert results into an array

$onlinecount = mysql_query("SELECT * FROM Presence");

$finalcount = mysql_num_rows($onlinecount);


echo "<h1><strong><u>HG Traveler Last $last Region Visits</u></strong></h1>";

echo "Users online now: $finalcount<br>";
echo "latest visits first.\n";

 //echo "<br>$query<br>";   
        
        // execute query 
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

// see if any rows were returned 
if (mysql_num_rows($result) > 0) { 
    // yes 
    // print them one after another 
define('COLS', 2); // number of columns
$col = 0; // number of the last column filled

echo '<table border="5px" CELLPADDING="6" BORDERCOLOR="383838" width="500px ">';
echo '<tr>'; // start first row

while ($rows = mysql_fetch_array($result))
{ $col++;
  if ($col == COLS) // have filled the last row
  { $col = 1; 
  	
    echo '</tr><tr>'; // start a new one
    echo '<center>';
  }
  echo '<td> <b><i><u><FONT SIZE=+1 COLOR=#00CC00>', $rows[3], '</b></i></u></FONT> visited <b><FONT COLOR=#FFFF00>', $rows[1],'</b></FONT><br> at <FONT COLOR=#FFFFFF>', $rows[8],'</FONT><br>From IP: ', $rows[5],'<br>Country: ', $rows[6],'<br>Viewer: ', $rows[7], '</center>', '</td>';
 
}

echo '</tr>'; // end last row
echo "</table>";
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
