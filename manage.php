<?php

/**
 * @package     local_message
 * @author      Viet
 * @License     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/message/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Manage message');

$messages = $DB->get_records('local_message');
$arrsearch = array('success','warning','error','info');
$arrReplace = array('Thành công','Cảnh báo','Lỗi','Thông tin');

echo $OUTPUT->header();

$templatecontext = (object) [
    'messages' => array_values($messages),
    'editurl' => new moodle_url('/local/message/edit.php'),
    'deleteurl' => new moodle_url('/local/message/delete.php'),
    'createurl' => new moodle_url('/local/message/create.php'),
    'header' => 'List of notfications'
];

echo $OUTPUT->render_from_template('local_message/manage',$templatecontext);

echo $OUTPUT->footer();