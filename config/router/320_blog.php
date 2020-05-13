<?php
/**
 * Content controller
 */
return [
    "routes" => [
        [
            "info" => "Content pagecontroller",
            "mount" => "content/blog",
            "handler" => "\Bjos\Content\ContentPostController",
        ],
    ]
];
