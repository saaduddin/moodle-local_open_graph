<?php
defined('MOODLE_INTERNAL') || die();

$definitions = [
    'opengraphtags' => [
        'mode' => cache_store::MODE_APPLICATION,
        'simplekeys' => true,
        'ttl' => 3600, // cache lifetime in seconds
    ]
];
