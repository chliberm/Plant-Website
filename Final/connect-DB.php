<!-- Connecting -->
<?php
$databaseName = 'CHLIBERM_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'chliberm_writer';
$password = 'jphKywnb7eDU';

$pdo = new PDO($dsn, $username, $password);
?>
<!-- Connection complete -->