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
 * Plugin upgrade steps are defined here.
 *
 * @package   local_open_graph
 * @copyright 2025 Saad Uddin
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Execute local_open_graph upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_open_graph_upgrade($oldversion) {
    global $DB;

    // Add default image on first install.
    if ($oldversion < 2025051300) {
        $fs = get_file_storage();
        $context = context_system::instance();

        // Check if we already have a default image.
        $files = $fs->get_area_files($context->id, 'local_open_graph', 'defaultimage', 0, 'itemid, filepath, filename', false);

        if (empty($files)) {
            $fileinfo = [
                'contextid' => $context->id,
                'component' => 'local_open_graph',
                'filearea' => 'defaultimage',
                'itemid' => 0,
                'filepath' => '/',
                'filename' => 'default-image.png',
            ];

            // Get the default image content from the plugin directory.
            $sourcepath = __DIR__ . '/../default-image.png';
            if (file_exists($sourcepath)) {
                $fs->create_file_from_pathname($fileinfo, $sourcepath);
            }
        }

        upgrade_plugin_savepoint(true, 2025051300, 'local', 'open_graph');
    }

    return true;
}
