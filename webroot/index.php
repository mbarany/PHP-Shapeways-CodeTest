<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

/**
 * #1 @see ./resources/schema.sql
 */

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_sqlite',
        'path' => __DIR__ . '/../app.db',
    ],
]);

function getLayout ($layout) {
    return file_get_contents(__DIR__ . '/../layouts/' . $layout . '.html');
}


// Routes
$app->get('/', function () {
    return getLayout('main');
});

/**
 * #2 How would you get the number of unread comments per product for a user?
 */
$app->get('/user/{user_id}/product/{product_id}/comments', function ($user_id, $product_id) use ($app) {
    $app['db']->exec('PRAGMA foreign_keys = ON;');
    $last_comment_id = $app['db']->fetchColumn(
        'SELECT last_comment_id FROM product_users WHERE user_id = ? AND product_id = ?',
        [$user_id, $product_id]
    ) ?: 0;
    $total = (int) $app['db']->fetchColumn(
        'SELECT COUNT(*) total FROM comments WHERE product_id = ? AND id > ? ORDER BY id',
        [$product_id, $last_comment_id]
    );
    return $app->json(['total' => $total]);
});

/**
 * #3 Write a request handler that adds a comment to a product.
 */
$app->post('/product/{product_id}/comment', function (Symfony\Component\HttpFoundation\Request $request, $product_id) use ($app) {
    $app['db']->exec('PRAGMA foreign_keys = ON;');
    $results = $app['db']->insert(
        'comments',
        [
            'product_id' => $product_id,
            'user_id' => $request->request->get('user_id'),
            'comment' => $request->request->get('comment'),
            'created_at' => (new DateTime())->format('c'),
        ]
    );
    if (count($results) !== 1) {
        $app->abort(400);
    }
    return new \Symfony\Component\HttpFoundation\Response('', 201);
});

$app->run();
