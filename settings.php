<?php
$settings->add(new admin_setting_configtext(
    'papercutws_quota/title',
    get_string('title', 'papercutws_quota'),
    get_string('title_desc', 'papercutws_quota'),
    'Printing Statistics',
    PARAM_RAW
));
$settings->add(new admin_setting_configtext(
    'papercutws_quota/authtoken',
    get_string('authtoken', 'papercutws_quota'),
    get_string('authtoken_desc', 'papercutws_quota'),
    '',
    PARAM_RAW
));
$settings->add(new admin_setting_configtext(
    'papercutws_quota/serveruri',
    get_string('serveruri', 'papercutws_quota'),
    get_string('serveruri_desc', 'papercutws_quota'),
    '',
    PARAM_RAW
));
$settings->add(new admin_setting_configtext(
    'papercutws_quota/port',
    get_string('port', 'papercutws_quota'),
    get_string('port_desc', 'papercutws_quota'),
    9191,
    PARAM_INT
));
$settings->add(new admin_setting_configcheckbox(
    'papercutws_quota/https',
    get_string('https', 'papercutws_quota'),
    get_string('https_desc', 'papercutws_quota'),
    0,
    PARAM_BOOL
));
