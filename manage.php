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
?>
<h1>List of notfication</h1>



<table style="width:100%" class="table">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nội dung thông báo</th>
        <th scope="col">Loại thông báo</th>
        <th scope="col">Tác vụ</th>
    </tr>
<?php
foreach ($messages as $message) {
    echo '
    <tr>
        <td scope="row">'.$message->id.'</td>
        <td>'.$message->message_text.'</td>
        <td>'.str_replace($arrsearch,$arrReplace,$message->message_type).'</td>
        <td>
            <input type="button" class="btn btn-danger" value="Delete" onclick="location.href=\''. new moodle_url('/local/message/delete.php',['id' => $message->id]).'\'">
        </td>
    </tr>';
}
echo    '</table>
        <div class="container">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" onclick="location.href=\''. new moodle_url('/local/message/create.php').'\'">Create</button>
                </div>
            </div>
        </div>';
echo $OUTPUT->footer();