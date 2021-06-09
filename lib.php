<?php

/**
 * @package     local_message
 * @author      Viet
 * @License     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');

function local_message_before_footer() {
  global $DB,$USER;

  $messages = $DB->get_records('local_message');

  foreach($messages as $message) {
    if ($message->message_type === 'success') $type = \core\output\notification::NOTIFY_SUCCESS;
    if ($message->message_type === 'warning') $type = \core\output\notification::NOTIFY_WARNING;
    if ($message->message_type === 'error') $type = \core\output\notification::NOTIFY_ERROR;
    if ($message->message_type === 'info') $type = \core\output\notification::NOTIFY_INFO;

    if ($message->user_recv === $USER->id) {
      \core\notification::add($message->message_text, $type);
    }
  }
}