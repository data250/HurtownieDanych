<?php
$user = 'root';
$password = '';
$database = 'pq';

mysql_connect('localhost', $user, $password);
@mysql_select_db($database) or die("Nie udało się wybrać bazy danych");
?>