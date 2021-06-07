<?php

/**
 * @package     local_message
 * @author      Viet
 * @License     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/message/delete.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Delete message');

$id = $_GET['id'];

$sql = 'DELETE FROM mdl_local_message WHERE id = '.$id;

$DB->execute($sql);

redirect($CFG->wwwroot . '/local/message/manage.php','Bạn đã xóa thông báo thành công.');