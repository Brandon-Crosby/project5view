<?php
namespace App\classes;
use \PDO;

class Comments
{
    protected $db;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
    /*public function getComments()
    {
        $results = $this->db->prepare(
            'SELECT * FROM posts ORDER BY id'
        );
        $results->execute();
        $Comments = $sql->fetchAll();
        //if (empty($Comments)) {
            //throw new ApiException(ApiException::comment_NOT_FOUND, 404);
        //}
        //return $Comments;
    }*/
    public function getComments($comment_id)
    {
        $results = $this->db->prepare(
            'SELECT * FROM comments WHERE postId= :postId'
        );
        $results->bindParam('id', $comment_id);
        $results->execute();
        return $results->fetchAll(PDO::FETCH_ASSOC);
        /*if (empty($comment)) {
            //throw new ApiException(ApiException::comment_NOT_FOUND, 404);
        }*/
        return $comment;
    }
    public function createComment($name, $comment, $comment_id)
    {

        $results = $this->db->prepare(
            'INSERT INTO Comments(name, body, comment_id) VALUES(:name, :body, :comment_id)'
        );
        $results->bindParam('title', $data['title']);
        $results->bindParam('url', $data['url']);
        $results->execute();
        if ($results->rowCount()<1) {
            //throw new ApiException(ApiException::comment_CREATION_FAILED);
        }
        return $this->getComments($this->db->lastInsertId());
    }
    public function updateComment($title, $date, $body)
    {
          /*if (empty($data['comment_id']) || empty($data['title']) || empty($data['url'])) {
            //throw new ApiException(ApiException::comment_INFO_REQUIRED);
        }*/
        $results = $this->database->prepare(
            'UPDATE courses SET title=:title, url=:url WHERE id=:id'
        );
        $results->bindParam('id', $id, PDO::PARAM_INT);
        $results->bindParam('title', $title, PDO::PARAM_STR);
        $results->bindParam('date', $date, PDO::PARAM_STR);
        $results->bindParam('body', $body, PDO::PARAM_STR);
        $results->execute();
        /*if ($results->rowCount()<1) {
            //throw new ApiException(ApiException::comment_UPDATE_FAILED);
        }*/
        return $this->get_comment($data['comment_id']);
    }
    public function delete_Comment($comment_id)
    {
        $this->getComments($comment_id);
        $results = $this->database->prepare(
            'DELETE FROM courses WHERE id=:id'
        );
        $results->bindParam('id', $comment_id);
        $results->execute();
        /*if ($results->rowCount()<1) {
            //throw new ApiException(ApiException::comment_DELETE_FAILED);
        }*/
        return ['message' => 'The comment was deleted'];
    }
}
