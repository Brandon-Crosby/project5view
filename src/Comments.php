<?php
namespace App;
use \PDO;

class Comments
{
    protected $db;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
  /*  public function getComment()
    {
        $results = $this->db->prepare(
            'SELECT * FROM posts ORDER BY id'
        );
        $results->execute();
        $Comments = $results->fetchAll();
        //if (empty($Comments)) {
            //throw new ApiException(ApiException::comment_NOT_FOUND, 404);
        //}
        //return $Comments;
    }*/

    /**
     *
     * Get all comments
     *
     * @param integer $comment_id
     *
     * @return $comment
     */
    public function getComments($comment_id){
        $results = $this->db->prepare('SELECT * FROM comments WHERE comment_Id= :comment_Id');
        $results->bindParam('comment_id', $comment_id);
        $results->execute();
        return $results->fetchAll(PDO::FETCH_ASSOC);
        /*if (empty($comment)) {
            //throw new ApiException(ApiException::comment_NOT_FOUND, 404);
        }*/
        return $comment;
    }
   /**
    *
    * Get all comments
    *
    * @param integer $comment_id
    *
    * @return $comment
    */
    public function createComment($name, $body, $comment_id){
        $results = $this->db->prepare('INSERT INTO Comments(name, body, comment_id) VALUES(:name, :body, :comment_id)');
        $results->bindParam(':name', $name, PDO::PARAM_STR);
        $results->bindParam(':body', $body, PDO::PARAM_STR);
        $results->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $results->execute();
        //if ($results->rowCount()<1) {
            //throw new ApiException(ApiException::comment_CREATION_FAILED);
        //}
        //return $this->getComments($this->db->lastInsertId());
        return true;
    }
  /*  public function updateComment($title, $date, $body)
    {
          /*if (empty($data['comment_id']) || empty($data['title']) || empty($data['url'])) {
            //throw new ApiException(ApiException::comment_INFO_REQUIRED);
        }
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
        }
        return $this->get_comment($data['comment_id']);
    }*/
    /*public function delete_Comment($comment_id)
    {
        $this->getComments($comment_id);
        $results = $this->database->prepare(
            'DELETE FROM courses WHERE id=:id'
        );
        $results->bindParam('id', $comment_id);
        $results->execute();
        /*if ($results->rowCount()<1) {
            //throw new ApiException(ApiException::comment_DELETE_FAILED);
        }
        return ['message' => 'The comment was deleted'];
    }*/
}
