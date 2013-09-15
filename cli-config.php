<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/requires.php';

$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
//$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__."/models/"));
$driverImpl = new Doctrine\ORM\Mapping\Driver\YamlDriver(realpath(__DIR__.'/yml/'));
//$driverImpl = new Doctrine\ORM\Mapping\Driver\XmlDriver(realpath(__DIR__.'/mapping/xml/'));

$config->setMetadataDriverImpl($driverImpl);

$config->setProxyDir(__DIR__ . '/proxies');
$config->setProxyNamespace('Proxies');


$connectionOptions = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'haxx',
    'dbname'   => 'comicpal',
);

$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helpers = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helpers);
