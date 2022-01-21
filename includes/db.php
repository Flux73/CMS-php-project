<?php 

$db = ['db_host' => 'localhost', 'db_user' => 'root', 'db_pass' => '', 'db_name' => 'cms'];

// $db['db_host'] = "localhost";
// $db['db_user'] = "root";
// $db['db_pass'] = "";
// $db['db_name'] = "cms";

foreach($db as $key => $value) {

    define(strtoupper($key), $value);

    // const DB_HOST = 'localhost';

}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if($connection)
// {
//     echo "true";
// } else {
//     echo mysqli_connect_error();
// }

?>