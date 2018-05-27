<?php
session_start();
$connection = mysql_connect('localhost','root','');
if(!$connection)
{
    echo "Connection Error";
}

$database = mysql_select_db('practice');
if(!$database)
{
    echo "Database is Not Select";
}
    


?>