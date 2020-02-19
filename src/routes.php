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
$app->get('/create', function ($request, $response) {
    // Sample log message
    //$this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'new.twig');
});



/*make new entry page
$app->get('/', function ($request, $response) {
    // Sample log message
    //$this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'new.twig');
});

//create Post
$app->post('/', function($request, $response, $args) {
    //new post object
    $post = new Post($this->db);

    $args = array_merge($args, $request->getParsedBody());

    //date year month day
    $args['date'] = date('Y-m-d');

    // Add post
    // vaildation if title date & body are set log details
    if (!empty($args['title']) && !empty($args['date']) && !empty($args['body'])) {
      //Calls create post method
      $results = $post->createPost($args['title'], $args['date'], $args['body']);
      //add posts to args array
      $args['posts'] = $results;

  }
      //set url new
      //router uses request & respond cycle
      $url = $this->router->pathFor('new');
      //redirect to index
      return $response->withStatus(302)->withHeader('Location', '/');
      })->setName('new');


*/



//default route
$app->get('/', function($request, $response, $args) {
    //new post object
    $post = new Post($this->db);
    $results = $post->getPosts();
    $args['posts']=$results;
return $this->view->render($response, 'home.twig', $args);
});
