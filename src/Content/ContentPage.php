<?php

namespace Bjos\Content;

use Bjos\TextFilter\MyTextFilter;

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
        $this->textFilter = new MyTextFilter();
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
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
;
EOD;
        $content = $this->db->executeFetch($sql, [$route, "page"]);

        if ($content) {
            $filters = $content->filter;
            if ($filters) {
                $arrayFilter = explode(",", $filters);

                array_unshift($arrayFilter, "strip");

                $content->data = $this->textFilter->parse($content->data, $arrayFilter);
            }
        }

        return $content;
    }
}
