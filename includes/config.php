<?php


// database config inofmation. change in case of need;
$DB_HOST = "localhost";
$DB_PORT = 3306;
$DB_USER = "root";
$DB_PASSWORD = "";
$DB_NAME = "attendify";

$DB = new PDO("mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASSWORD);

// set database attributes;
$DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$DB->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

define("APP_NAME", "attendifyAPI");
