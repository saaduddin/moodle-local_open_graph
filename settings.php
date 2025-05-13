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
 * Plugin settings
 *
 * @package   local_open_graph
 * @copyright 2025 Saad Uddin
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_open_graph', get_string('pluginname', 'local_open_graph'));
    $settings->add(
        new admin_setting_configtext(
            'local_open_graph/defaultdescription',
            get_string('defaultdescription', 'local_open_graph'),
            get_string('defaultdescription_desc', 'local_open_graph'),
            'A Moodle site using Open Graph.'
        )
    );
    $settings->add(
        new admin_setting_configstoredfile(
            'local_open_graph/defaultimage',
            get_string('defaultimage', 'local_open_graph'),
            get_string('defaultimage_desc', 'local_open_graph'),
            'defaultimage',
            0,
            ['maxfiles' => 1, 'accepted_types' => ['image']]
        )
    );
    $settings->add(
        new admin_setting_configcheckbox(
            'local_open_graph/enabletwittertags',
            get_string('enabletwittertags', 'local_open_graph'),
            get_string('enabletwittertags_desc', 'local_open_graph'),
            1
        )
    );
    $ADMIN->add('localplugins', $settings);
}
