<?php

namespace Bjos\Content;

class Content
{
    /**
     * @var object $db database object.
     */
    private $db;


    /**
     * @var object $db database object.
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->db->connect();
    }



    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function showAllContent()
    {
        $sql = "SELECT * FROM content;";
        $resultset = $this->db->executeFetchAll($sql);
        return $resultset;
    }



    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function showAllExistingContent()
    {
        $sql = "SELECT * FROM content WHERE deleted IS NULL;";
        $resultset = $this->db->executeFetchAll($sql);
        return $resultset;
    }



    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function editContent($params)
    {
        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $this->db->execute($sql, array_values($params));
    }



    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function getContentById($id)
    {
        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->db->executeFetch($sql, [$id]);
        return $content;
    }


    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function createContent($title)
    {
        $sql = "INSERT INTO content (title) VALUES (?);";
        $this->db->execute($sql, [$title]);
        $id = $this->db->lastInsertId();
        return $id;
    }



    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function countContent()
    {
        $sql = "SELECT COUNT(id) AS max FROM content;";
        $count = $this->db->executeFetchAll($sql);
        return $count[0];
    }
}
