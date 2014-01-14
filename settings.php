<?php
$settings->add(new admin_setting_configtext(
    'papercutws_quota/title',
    get_string('title', 'block_papercutws_quota'),
    get_string('title_desc', 'block_papercutws_quota'),
    'Printing Statistics',
    PARAM_RAW
));
$settings->add(new admin_setting_configtext(
    'papercutws_quota/authtoken',
    get_string('authtoken', 'block_papercutws_quota'),
    get_string('authtoken_desc', 'block_papercutws_quota'),
    '',
    PARAM_RAW
));
$settings->add(new admin_setting_configtext(
    'papercutws_quota/serveruri',
    get_string('serveruri', 'block_papercutws_quota'),
    get_string('serveruri_desc', 'block_papercutws_quota'),
    '',
    PARAM_RAW
));
$settings->add(new admin_setting_configtext(
    'papercutws_quota/port',
    get_string('port', 'block_papercutws_quota'),
    get_string('port_desc', 'block_papercutws_quota'),
    9191,
    PARAM_INT
));
$settings->add(new admin_setting_configcheckbox(
    'papercutws_quota/https',
    get_string('https', 'block_papercutws_quota'),
    get_string('https_desc', 'block_papercutws_quota'),
    0,
    PARAM_BOOL
));
