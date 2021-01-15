<?php


namespace app\models;


use app\libraries\Database;

class PostsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query('SELECT post_id,posts.user_id,title,body,
                                posts.created_at as p_created_at,name,
                                users.created_at as u_created_at FROM posts 
                                JOIN users on posts.user_id = users.user_id
                                ORDER BY p_created_at DESC');
        return $results = $this->db->resultSet();

    }

    public function addPost($user_id, $title, $body)
    {
        $this->db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
        $this->db->bind(':title', $title);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':body', $body);
        return $this->db->execute();
    }

    public function getPost($id)
    {
        $this->db->query('SELECT * FROM posts WHERE post_id=:id;');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updatePost($post_id, $title, $body)
    {
        $this->db->query('UPDATE posts SET title=:title, body=:body
                                WHERE post_id=:post_id;');
        $this->db->bind(':post_id', $post_id);
        $this->db->bind(':title', $title);
        $this->db->bind(':body', $body);
        return $this->db->execute();
    }

    public function deletePost($post_id)
    {
        $this->db->query('DELETE FROM posts WHERE post_id=:post_id;');
        $this->db->bind(':post_id', $post_id);
        return $this->db->execute();
    }
}