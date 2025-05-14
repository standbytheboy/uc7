<?php

require 'Database.php';

$myDB = new Database();

echo'<pre>';
print_r($myDB->getAll());
echo'</pre>';