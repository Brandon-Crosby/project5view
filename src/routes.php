<?php
// Routes
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Post;
use App\Comments;
use Slim\Views\Twig;

$container = $app->getContainer(); //

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
  $post = new Post($this->db);
//Comments
  $Comment = new Comments($this->db);
//$post = new Post($this->db);

//$this->logger->info->('/detail');

//Comments
  $results = $post->getPost($args['id']);
  $args['post'] = $results;
  //$comment_results = $comment->getComments($args['id']);
  //$args['comments'] = $comment_results;
  //$comment_results = $comment;


//render detail view
  return $this->view->render($response, 'detail.twig', $args);
  // echo '<pre>';
  // var_dump($args);
  // echo '</pre>';

  })->setName('detail');

//Edit Route
$app->map(['GET', 'POST'], '/edit/{id}', function ($request, $response, $args) {
    if($request->getMethod()== "GET"){

    $post = new Post($this->db);
    //$args = array_merge($args, $request->getParsedBody());
    //$this->logger->info->('/edit');
    $results = $post->getPost($args['id']);
    $args['post'] = $results;
    var_dump($args);
  }
//run only on post
      if($request->getMethod() == "POST") {
        $post = new Post($this->db);
        $args = array_merge($args, $request->getParsedBody());
        //Update Post Method
        var_dump($post);
        $results = $post->updatePost($args['id'], $args['title'], $args['date'], $args['body']);
        //return Detail
        //var_dump($args);
        return $this->response->withStatus(302)->withHeader('Location', '/detail/'. $args['id'] );
      } return $this->view->render($response, 'edit.twig', $args);
    });






//nested array -



//get display
//default route
$app->get('/', function($request, $response, $args) {
    //new post object
    $post = new Post($this->db);
    $results = $post->getPosts();
    $args['posts']=$results;
return $this->view->render($response, 'index.twig', $args);
});
