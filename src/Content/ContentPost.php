<?php

namespace Bjos\Content;

use Bjos\TextFilter\MyTextFilter;

class ContentPost
{
    /**
     * @var object $db database object.
     */
    private $db;
    private $textFilter;


    /**
     * @var object $db database object.
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->db->connect();
        $this->textFilter = new MyTextFilter();
    }



    /**
     * Method to get all posts
     *
     * @return object $resultset
     */
    public function showAllPosts()
    {
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, ["post"]);
        foreach ($resultset as $row) {
            if ($row->filter) {
                $arrayFilter = explode(",", $row->filter);
                array_unshift($arrayFilter, "strip");
                try {
                    $row->data = $this->textFilter->parse($row->data, $arrayFilter);
                } catch (\Bjos\TextFilter\MyTextFilterException $e) {
                    $row->error = $e->getMessage();
                }
            }
        }
        return $resultset;
    }


    /**
     * Method to get all posts
     *
     * @param string $slug
     *
     * @return object $resultset
     */
    public function showPost($slug)
    {
        $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
slug = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
ORDER BY published DESC
;
EOD;
        $content = $this->db->executeFetch($sql, [$slug, "post"]);

        if ($content) {
            $filters = $content->filter;
            if ($filters) {
                $arrayFilter = explode(",", $filters);
                array_unshift($arrayFilter, "strip");

                try {
                    $content->data = $this->textFilter->parse($content->data, $arrayFilter);
                } catch (\Bjos\TextFilter\MyTextFilterException $e) {
                    $content->error = $e->getMessage();
                }
            }
        }

        return $content;
    }
}
