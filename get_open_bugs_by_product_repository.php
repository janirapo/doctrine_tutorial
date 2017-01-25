<?php
// get_open_bugs_by_product_repository.php
require_once "bootstrap.php";

$res = $entityManager->getRepository('Bug')->getOpenBugsByProduct();

foreach ($res as $i) {
    echo "Product ID: ".$i['id'].", Product name: ".$i['name'].", count: ".$i['openBugs'];
    echo "\n";
}
