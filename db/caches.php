<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Cache definitions for the Open Graph plugin.
 *
 * @package   local_open_graph
 * @copyright 2025 Saad Uddin
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3
 */

defined('MOODLE_INTERNAL') || die();

$definitions = [
    'opengraphtags' => [
        'mode' => cache_store::MODE_APPLICATION,
        'simplekeys' => true,
        // Cache lifetime is set to one hour.
        'ttl' => 3600,
    ],
];
