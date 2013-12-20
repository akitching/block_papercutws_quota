<?php
class block_papercutws_quota extends block_list {
    public function init() {
        $this->title = get_string('papercutws_quota', 'block_papercutws_quota');
        $this->auth_token = get_config('papercutws_quota', 'authtoken');
        $this->http = get_config('papercutws_quota', 'https') ? 'https' : 'http';
        $this->serveruri = get_config('papercutws_quota', 'serveruri');
        $this->port = get_config('papercutws_quota', 'port');
    }

    public function specialization() {
        global $CFG;
        $title = get_config('papercutws_quota', 'title');

        if (!empty($this->config) && !empty($this->config->title)) {
            // There is a customized block title, display it
            $this->title = $this->config->title;
        } elseif (!empty($title)) {
             $this->title = $title;
        }
    }

    public function get_content() {
        global $CFG, $USER, $OUTPUT;
        if ($this->content !== null) {
            return $this->content;
        }
        if ($USER->username == null || $USER->username == '') {
            return false;
        }

        $this->content          = new stdClass;
        $this->content->text    = 'Test';
        $this->content->footer  = '';
        $this->content->items   = Array();
        $this->content->icons   = Array();

        if ( ! class_exists(xmlrpc_client)) {
            include('lib/xmlrpc.inc');
        }
        $this->pwsclient = new xmlrpc_client(
            '/rpc/api/xmlrpc',
            $this->serveruri,
            $this->port,
            $this->http
        );

        $this->pwsclient->return_type = 'phpvals';
        $restricted = $this->call_api(
            'getUserProperty',
            array(
                new xmlrpcval(
                    'restricted',
                    'string'
                ),
            )
        );
        if ($restricted == 'false') {
            return false;
        }
        // Balance
        $balance = $this->call_api(
            'getUserAccountBalance',
            array(
            )
        );
        if ($balance !== false) {
            $this->content->items[] = (strstr($balance, '-') ? '-' : '') . '£' . str_replace('-', '', $balance);
            $this->content->icons[] = $OUTPUT->pix_icon(
                'Farm-Fresh_total_plan_cost',
                get_string(
                    'quota',
                    'block_papercutws_quota'
                ),
                'block_papercutws_quota'
            );
        }

        return $this->content;
    }

    function call_api($name, $data) {
        global $USER;
        array_unshift($data, new xmlrpcval($USER->username, 'string'));
        array_unshift($data, new xmlrpcval($this->auth_token, 'string'));
        $message = new xmlrpcmsg('api.' . $name, $data);
        $response = $this->pwsclient->send($message);

        if ($response->faultCode()) {
            return 'ERROR: ' . $response->faultString();
            return false;
        } else {
            return $response->value();
        }
    }

    public function has_config() {
        return true;
    }

}
