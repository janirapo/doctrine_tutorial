<?php
// dashboard2.php
require_once "bootstrap.php";

$theUserId = $argv[1];

$qb = $entityManager->createQueryBuilder();
$qb->select('b, e, r')
	->from('Bug', 'b')
	->join('b.engineer', 'e')
	->join('b.reporter', 'r')
	->where("b.status = 'OPEN'")
	->andWhere($qb->expr()->orX('e.id = :userId', 'r.id = :userId'))
	->orderBy('b.created', 'DESC');

$myBugs = $qb->getQuery()
			->setParameter(':userId', $theUserId)
            ->setMaxResults(15)
            ->getResult();

echo "You have created or assigned to " . count($myBugs) . " open bugs:\n\n";

foreach ($myBugs as $bug) {
    echo $bug->getId() . " - " . $bug->getDescription()."\n";
}
