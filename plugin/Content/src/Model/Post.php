<?php
/**
 * TinkerPlugin Model
 */
namespace Content\Model;

/**
 * TinkerPlugin Model
 *
 * This is a simple mock up of a model. A fully developed version would likely
 * return a result set from a database query, contents of a file, etc.
 */
class Post
{

    /**
     * PDO Object
     * @var Object
     */
    public $Pdo;

    /**
     * Initialize the object
     * @param object $args
     */
    public function __construct(){

        $this->connect();
    }

    /**
     * Provides a method for connecting to the DB.
     */
    public function connect(){

        $this->Pdo = new \PDO(
            "mysql:host=localhost;"
                . "dbname=jasonsnider;"
                . "charset=utf8",
            'root',
            'password'
        );

        $this->Pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->Pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

    }

    /**
     * Returns all blog posts
     *
     * @return array
     */
    public function posts(){
        $query = "SELECT * FROM contents WHERE content_type='post' ORDER BY created DESC";
        $rs = $this->Pdo->prepare($query);
        $rs->execute();

        return $rs;
    }

    /**
     * Returns a single blog post with a reference to it's neighbors
     *
     * @param string $token
     * @return array
     */
    public function post($token){
        $query = "SELECT * FROM contents WHERE slug = :slug OR id = :id";
        $rs = $this->Pdo->prepare($query);
        $rs->bindParam(':slug', $token);
        $rs->bindParam(':id', $token);
        $rs->execute();

        $post = $rs->fetch();

        $postData = array(
            'post'=>$post,
            'next'=>$this->next($post['created']),
            'prev'=>$this->prev($post['created'])
        );

        return $postData;
    }

    /**
     * Returns the next post
     *
     * @param string $created
     * @return array
     */
    public function next($created){
        $query = "SELECT slug FROM contents WHERE created < '{$created}' AND content_type='post' ORDER BY created DESC LIMIT 1";
        $rs = $this->Pdo->prepare($query);
        $rs->bindParam(':slug', $token);
        $rs->bindParam(':id', $token);
        $rs->bindParam(':created', $created);
        $rs->execute();

        return $rs->fetch();
    }

    /**
     * Returns the previous post
     *
     * @param string $created
     * @return array
     */
    public function prev($created){
        $query = "SELECT slug FROM contents WHERE created > '{$created}' AND content_type='post' ORDER BY created ASC LIMIT 1";
        $rs = $this->Pdo->prepare($query);
        $rs->bindParam(':slug', $token);
        $rs->bindParam(':id', $token);
        $rs->bindParam(':created', $created);
        $rs->execute();

        return $rs->fetch();
    }
}
