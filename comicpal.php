<?php
require_once __DIR__."/vendor/autoload.php";
require_once __DIR__.'/requires.php';


use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ArrayCache;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();
$app['debug'] = true;

// DB
$app->register(new DoctrineServiceProvider(), array(
    'db.options'            => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
		'dbname'	=> 'comicpal',
		'user'		=> 'root',
		'password'	=> 'haxx'
    ),
));


// Register Doctrine ORM
$app->register(new DoctrineOrmServiceProvider(), array(
    "orm.proxies_dir" => __DIR__."/proxies",
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "annotation",
                "namespace" => "models",
                "path" => __DIR__."/models",
                "use_simple_annotation_reader" => false,
            ),
        ),
    ),
));


// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/templates',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
    'twig.options' => array('cache' => __DIR__.'/cache'),
));
$app['twig']->addFilter('nl2br', new Twig_Filter_Function('nl2br', array('is_safe' => array('html'))));


// List
$app->get('/', function () use ($app) {

    $author = $app['orm.em']->find('models\Author', 1);
    return $app['twig']->render('index.twig.html', array('authors' => array($author)));

    //return "done";

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