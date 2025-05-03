<?php
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
