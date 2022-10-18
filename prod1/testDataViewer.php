<?php
require 'sessioncon.php';
$testData = $testCol->find();
echo "<pre>";
foreach($testData as $data)
{
    var_dump($data);
}
echo "</pre>";
?>