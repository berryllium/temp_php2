<?php
require_once('SQL.php');
$db = SQL::Instance();
print_r ($db->Select('products'));