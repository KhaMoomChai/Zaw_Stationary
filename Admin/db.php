<?php
$servername = "localhost";$username = "root";$password = "";
$dbname = "stationary";
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username,
                                  $password);
                                }
                                catch(PDOException $e)
                                    {
                                    echo  $e->getMessage();
                                    }
?>
