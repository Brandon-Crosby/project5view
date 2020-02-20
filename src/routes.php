<?php
// Routes
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Post;
use App\Comments;
use Slim\Views\Twig;

$container = $app->getContainer();

//Routes
//create and post
$app->get('/new', function ($request, $response) {
    // Render index view
    return $this->view->render($response, 'new.twig');
});
$app->post('/new', function ($request,$response,$args) {
    //db
    $post = new Post($this->db);
    //post details stored
    $args = array_merge($args, $request->getParsedBody());
    //datefmt_create
    $args['date'] = date('Y-m-d');
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

//GET detail Twig
$app->get('/detail/{id}', function($request, $response, $args){
    //$post = new Post($this->db);
//Comments
//$Comment = new Comments($this->db);
$post = new Post($this->db);

//$this->logger->info->('/detail');

//Comments
$results = $post->getPost($args['id']);
$args['post'] = $results;
//$comment_results = $comment->getComments($args['id']);
$args['comments'] = $comment_results;
//$comment_results = $comment;


//render detail view
    return $this->view->render($response, 'detail.twig', $args);
  })->setName('detail');













//get display
//default route
$app->get('/', function($request, $response, $args) {
    //new post object
    $post = new Post($this->db);
    $results = $post->getPosts();
    $args['posts']=$results;
return $this->view->render($response, 'index.twig', $args);
});
