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
//
// @copyright 2025 Saad Uddin
// @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
// @package   local_open_graph

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_open_graph', get_string('pluginname', 'local_open_graph'));
    $settings->add(new admin_setting_configtext(
        'local_open_graph/defaultdescription',
        get_string('defaultdescription', 'local_open_graph'),
        get_string('defaultdescription_desc', 'local_open_graph'),
        'A Moodle site using Open Graph'
    ));
    $ADMIN->add('localplugins', $settings);
}
