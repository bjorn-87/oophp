<?php

namespace Bjos\Content;

class Content
{
    /**
     * @var object $db database object.
     */
    private $db;


    /**
     * Constructor for Content
     *
     * @param object $db database object.
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->db->connect();
    }



    /**
     * Method to get all content from content table.
     *
     * @return array $resultset
     */
    public function showAllContent()
    {
        $sql = "SELECT * FROM content;";
        $resultset = $this->db->executeFetchAll($sql);
        return $resultset;
    }



    /**
     * Method to get all content except deleted
     *
     * @return array $resultset.
     */
    public function showAllExistingContent()
    {
        $sql = "SELECT * FROM content WHERE deleted IS NULL;";
        $resultset = $this->db->executeFetchAll($sql);
        return $resultset;
    }



    /**
     * Method to edit content from table content.
     *
     * @return void.
     */
    public function editContent($params)
    {
        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=?, deleted=NULL WHERE id = ?;";
        $this->db->execute($sql, array_values($params));
    }



    /**
     * Method to get content by id.
     *
     * @param int $id the id of the content to get.
     *
     * @return array $content resultset from query.
     */
    public function getContentById($id)
    {
        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->db->executeFetch($sql, [$id]);
        return $content;
    }


    /**
     * Method to insert new content.
     *
     * @param string $title title of the new content.
     *
     * @return int $id Last inserted id.
     */
    public function createContent($title)
    {
        $sql = "INSERT INTO content (title) VALUES (?);";
        $this->db->execute($sql, [$title]);
        $id = $this->db->lastInsertId();
        return $id;
    }



    /**
     * Method to get the number of rows in the table.
     *
     * @return int $count[0].
     */
    public function countContent()
    {
        $sql = "SELECT COUNT(id) AS max FROM content;";
        $count = $this->db->executeFetchAll($sql);
        return $count[0];
    }



    /**
     * Method to soft delete content
     *
     * @return void.
     */
    public function deleteContent($id)
    {
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $this->db->execute($sql, [$id]);
    }



    /**
     * Method to check if a slug exists.
     *
     * @return int $count[0].
     */
    public function checkSlug($slug, $id)
    {
        $sql = "SELECT id FROM content WHERE slug=? AND NOT id=?;";
        $content = $this->db->executeFetchAll($sql, [$slug, $id]);
        return $content;
    }



    /**
     * Method to check if a path exists
     *
     * @return int $.
     */
    public function checkPath($path, $id)
    {
        $sql = "SELECT id FROM content WHERE path=? AND NOT id=?;";
        $content = $this->db->executeFetchAll($sql, [$path, $id]);
        return $content;
    }
}
