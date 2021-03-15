<?php

/**
 * @package     local_message
 * @author      Viet
 * @License     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 function local_message_before_footer() {
    \core\notification::add('a test message 12222234 ', \core\output\notification::NOTIFY_SUCCESS);
 }