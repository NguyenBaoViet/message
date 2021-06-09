<?php

/**
 * @package     local_message
 * @author      Viet
 * @License     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot . '/local/message/classes/form/edit.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit message');

//get id
$id = isset($_GET['id']) ? $_GET['id'] : null;

//get list user
$users = $DB->get_records('user');

$arr['-1'] = "Tất cả người dùng";

foreach ($users as $user) {
    $arr[$user->id] = $user->firstname.' '.$user->lastname;
}



//get message
$message = $DB->get_record('local_message',['id' => $id]);

// display our form
$mform  = new edit(null, array('user_list' => $arr, 
                                'messagetext' => $message->message_text,
                                'messagetype' => $message->message_type, 
                                'userID' => $message->user_recv, 
                                'id' => $id,
                                'timebegin' => $message->time_begin,
                                'timestop' => $message->time_stop));

//set defalt data

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    // go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php','Bạn đã hủy tạo thông báo.');

} else if ($fromform = $mform->get_data()) {
    // Insert data to database
    $dataUpdate = new stdClass();
    $dataUpdate->id = $fromform->id;
    $dataUpdate->message_text = $fromform->messagetext;
    $dataUpdate->message_type = $fromform->messagetype;
    $dataUpdate->user_recv = $fromform->userID;
    $dataUpdate->time_begin = $fromform->timebegin;
    $dataUpdate->time_stop = $fromform->timestop;

    $DB->update_record('local_message', $dataUpdate);

    // go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php','Bạn đã chỉnh sửa thông báo thành công.');

} 

echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();