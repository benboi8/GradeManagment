<?php

defined('MOODLE_INTERNAL') || die;

if (is_siteadmin()) {
    $settings->add(
        new admin_setting_configtext(
            'gradereport_gradingmanager_test',
            'test',
            'test',
            40,
            PARAM_INT
        )
    );
}
