<?php

/**
 * @package     local_message
 * @author      Viet
 * @License     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");



require_once 'HTML/QuickForm.php';
require_once 'HTML/QuickForm/DHTMLRulesTableless.php';
require_once 'HTML/QuickForm/Renderer/Tableless.php';
require_once 'HTML/QuickForm/Rule.php';

require_once $CFG->libdir.'/filelib.php';

class edit extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('hidden','id',$this->_customdata['id']);

        //Nội dung thông báo
        $mform->addElement('textarea', 'messagetext', 'Message text', 'wrap="virtual" rows="10" cols="50"');
        $mform->setType('messagetext', PARAM_NOTAGS);  
        $mform->addRule('messagetext', 'Vui lòng nhập thông báo', 'required', 'extraruledata', 'server', false, false);
        $mform->setDefault('messagetext', $this->_customdata['messagetext']);
        
        //Loại thông báo
        $choices = array(
            'success' => \core\output\notification::NOTIFY_SUCCESS,
            'warning' => \core\output\notification::NOTIFY_WARNING,
            'error' => \core\output\notification::NOTIFY_ERROR,
            'info' => \core\output\notification::NOTIFY_INFO,
        );
        $mform->addElement('select','messagetype','Message Type',$choices);
        $mform->setDefault('messagetype', $this->_customdata['messagetype']);

        //Người dùng nhận thông báo
        $userChoices = $this->_customdata['user_list'];
        $mform->addElement('select', 'userID', 'User', $userChoices);
        $mform->setDefault('userID', $this->_customdata['userID']);

        //thời gian bắt đầu thông báo
        $mform->addElement('date_time_selector', 'timebegin','Thông báo bắt đầu từ ngày');
        $mform->setDefault('timebegin', $this->_customdata['timebegin']);

        //thời hạn kết thúc thông báo
        $mform->addElement('date_time_selector', 'timestop','Thông báo tồn tại đến ngày');
        $mform->setDefault('timestop', $this->_customdata['timestop']);
        
        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}