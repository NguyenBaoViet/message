<?php

/**
 * @package     local_message
 * @author      Viet
 * @License     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot . '/local/message/classes/form/create.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/message/create.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Create message');

//get list user
$users = $DB->get_records('user');

foreach ($users as $user) {
    $arr[$user->id] = $user->firstname.' '.$user->lastname;
}

// display our form
$mform  = new create(null, array('user_list' => $arr));

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    // go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php','Bạn đã hủy tạo thông báo.');

} else if ($fromform = $mform->get_data()) {
    // Insert data to database
    $dataInsert = new stdClass();
    $dataInsert->message_text = $fromform->messagetext;
    $dataInsert->message_type = $fromform->messagetype;
    $dataInsert->user_recv = $fromform->userID;

    $DB->insert_record('local_message', $dataInsert);

    // go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php','Bạn đã tạo thông báo thành công.');

} 

echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();