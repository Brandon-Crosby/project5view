<?php
namespace App;
use \PDO;

class Post
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getPost($id)
    {
        $results = $this->db->prepare('SELECT * FROM posts WHERE id=:id' );
        $results->bindParam('id', $id);
        $results->execute();
        $post = $results->fetch();
        return $post;

    }

    public function getPosts()
    {
        $results = $this->db->prepare(
            'SELECT * FROM posts ORDER BY date DESC'
        );
        //$results->bindParam('id', $post_id);
        $results->execute();
        return $results->fetchAll(PDO :: FETCH_ASSOC);
        return $post;
    }
    //Create Journal Entry
    public function createPost($title, $date, $body)
    {
        $results = $this->db->prepare('INSERT INTO posts (title, date, body) VALUES (:title, :date, :body)');
        $results->bindParam(':title', $title, PDO::PARAM_STR);
        $results->bindParam(':date', $date, PDO::PARAM_STR);
        $results->bindParam(':body', $body, PDO::PARAM_STR);
        $results->execute();
        return true;
    }
    public function updatePost($id, $title, $date, $body)
    {
        //if (empty($data['Post_id']) || empty($data['title']) || empty($data['url'])        }
        $results = $this->database->prepare('UPDATE posts SET title=:title, date = :date, body=:body WHERE id=:id');
        $results->bindParam(':id', $data, PDO::PARAM_INT);
        $results->bindParam(':title', $title, PDO::PARAM_STR);
        $results->bindParam(':date', $date, PDO::PARAM_STR);
        $results->bindParam(':body', $body, PDO::PARAM_STR);
        $results->execute();
        //return $this->getPost($data['id']);
        return true;
    }
  /*  public function delete_Post($Post_id)
    {
        $this->getPosts($Post_id);
        $results = $this->database->prepare(
            'DELETE FROM posts WHERE id=:id'
        );
        $results->bindParam('id', $Post_id);
        $results->execute();
        return ['message' => 'The post was deleted'];
    }
*/
}
