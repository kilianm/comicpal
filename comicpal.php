<?php
use \Doctrine\Common\Cache\ApcCache;
use \Doctrine\Common\Cache\ArrayCache;

$app = new Silex\Application();
$app->em = $entityManager;
$app['debug'] = true;

// DB
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'            => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
		'dbname'	=> 'comicpal',
		'user'		=> 'root',
		'password'	=> 'haxx'
    ),
    'db.dbal.class_path'    => __DIR__.'/vendor/doctrine-dbal/lib',
    'db.common.class_path'  => __DIR__.'/vendor/doctrine-common/lib',
));

// Register Doctrine ORM
$app->register(new Nutwerk\Provider\DoctrineORMServiceProvider(), array(
    'db.orm.proxies_dir'           => __DIR__ . '/cache/doctrine/proxy',
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.cache'                 => 
        !$app['debug'] && extension_loaded('apc') ? new ApcCache() : new ArrayCache(),
    'db.orm.auto_generate_proxies' => true,
    'db.orm.entities'              => array(array(
        'type'      => 'annotation',       // entity definition 
        'path'      => __DIR__ . '/models',   // path to your entity classes
        'namespace' => 'models', // your classes namespace
    )),
));

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/templates',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
    'twig.options' => array('cache' => __DIR__.'/../cache'),
));
$app['twig']->addFilter('nl2br', new Twig_Filter_Function('nl2br', array('is_safe' => array('html'))));

require_once "models/Author.php";
use \models\Author;

// List
$app->get('/', function () use ($app) {

    $authors = $app['db.orm.em']->find('Author', 2);
    var_dump($authors);

    

//    $sql = "SELECT * FROM author;";
//    $query = $entityManager->createQuery($sql);
//    var_dump( $query->getArrayResult() );

//    $posts = $app['db']->fetchAll($sql);
//    return $app['twig']->render('index.twig.html', array('posts' => $posts));
});

// Item
$app->get('/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM Posts WHERE id = ?";
    $post = $app['db']->fetchAssoc($sql, array((int) $id));
    return $app['twig']->render('view.twig.html', array('post' => $post));
});

$app->run();
?>