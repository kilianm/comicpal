<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// cli-config.php
require_once __DIR__.'/bootstrap.php';

// Any way to access the EntityManager from  your application
$em = $entityManager;

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
?>