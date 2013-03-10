<body bgcolor="#000000" text="#990000">
<h1><strong><u>Last 25 Regions Visited</u></strong>
</h1>latest visits first.

<?php
//Developer: Watcher64 (watchersphone [at] gmail.com)
//Function : MODDED PHP Port for OpenSim-userlogmodule
//Source Tree : https://github.com/watcher64/MODDED_php_for_opensim-userlogmodule
//Modified by Watcher64
//Returns regions visists in a table one collum wide


//connect to the server

include("include/userlogdb.php");

mysql_connect ($DB_HOST, $DB_USER, $DB_PASSWORD);
mysql_select_db ($DB_NAME);
//query the database
$query = "SELECT * FROM TB_USERLOG_AGENTS ORDER BY count DESC LIMIT 25";
        
        // execute query 
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

// see if any rows were returned 
if (mysql_num_rows($result) > 0) { 
    // yes 
    // print them one after another 
    // change this to one number more
    // than the number of colums you want.
define('COLS', 2); // number of columns
$col = 0; // number of the last column filled

echo '<table border="1px" width="500px">';
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
