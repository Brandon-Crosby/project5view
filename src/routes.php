<?php
// Routes
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Post;
use App\Comment;
use Slim\Views\Twig;

$container = $app->getContainer();

//Routes
$app->get('/new', function ($request, $response) {
    // Render index view
    return $this->view->render($response, 'new.twig');
});
$app->post('/new', function ($request,$response,$args) {
    //db
    $post = new Post($this->db);
    //post details stored
    $args = array_merge($args, $request-getParsedBody());
    //datefmt_create
    $args['date'] = date('m-d-Y');
    //simple validation for input boxes
    if (!empty($args['title']) && !empty($args['date']) && !empty($args['body'])){
      $results = $post->createPost($args['title'],$args['date'],$args['body']);
    //add to args array
    $args['posts'] = $results;
    }
    // Render index view
    //return $this->view->render( $response, 'new.twig', $args);
    $url = $this->router->pathFor('new');
    //return to index
    return $response->withStatus(302)->withHeader('Location', '/');
    })->setName('new');


//get display
//default route
$app->get('/', function($request, $response, $args) {
    //new post object
    $post = new Post($this->db);
    $results = $post->getPosts();
    $args['posts']=$results;
return $this->view->render($response, 'index.twig', $args);
});
