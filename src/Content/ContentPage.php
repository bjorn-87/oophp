<?php

namespace Bjos\Content;

class ContentPage
{
    /**
     * @var object $db database object.
     */
    private $db;
    private $textFilter;


    /**
     * Constructor for ContentPage
     *
     * @param object $db database object.
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->db->connect();
        $this->textFilter = new \Bjos\TextFilter\MyTextFilter();
    }



    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function showAllPages()
    {
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, ["page"]);
        return $resultset;
    }


    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function showPage($route)
    {
        // Try matching content for type page and its path
        $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
path = ?
OR slug = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
;
EOD;
        $content = $this->db->executeFetch($sql, [$route, $route, "page"]);

        if ($content) {
            $filters = $content->filter;

            $arrayFilter = explode(",", $filters);

            array_unshift($arrayFilter, "esc");

            $content->data = $this->textFilter->parse($content->data, $arrayFilter);
        }

        return $content;
    }
}
