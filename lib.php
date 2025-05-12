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
 * Open Graph implementation for Moodle
 *
 * @package   local_open_graph
 * @copyright 2025 Saad Uddin
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Legacy callback for Moodle versions before 4.3
 */
function local_open_graph_before_http_headers() {
    if (!class_exists('\core\hook\manager')) {
        include_once(__DIR__ . '/classes/callbacks.php');
        \local_open_graph\callbacks::before_http_headers(new \stdClass());
    }
}
