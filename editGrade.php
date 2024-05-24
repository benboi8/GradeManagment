<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version metadata for the gradereport_gradingmanager plugin.
 *
 * @package   gradereport_gradingmanager
 * @copyright 2024, Ben Williams <benboi294@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// get config values
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/grade/report/gradingmanager/classes/forms/editGradeForm.php');

global $DB;

// page setup
$PAGE->set_url(new moodle_url(get_string("editPageUrl", "gradereport_gradingmanager")));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string("editTitle", "gradereport_gradingmanager"));

$mform = new editGradeForm();

echo $OUTPUT->header();


function getRecord($form) {
    $fromform = $form->get_data();


     if hidden element has id
    if ($fromform->id != null) {
        // set id to that id
        $recordid = $fromform->id;
    } else {
        // otherwise get the id from url
        if (array_key_exists('id', $_GET)) {
            $recordid = $_GET['id'];
        } else {
            $recordid = null;
        }

        if ($recordid == null) {
            redirect($CFG->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string('gradeNotFound', 'gradereport_gradingmanager'), null, \core\notification::ERROR);
        }

        // set hidden element to id for when page refreshes
        $form->set_data(array('id' => $recordid));
    }

    var_dump($recordid);

    if ($DB->record_exists("gradereport_gradingmanager", array("id" => $recordid))) {
        $record = $DB->get_record('gradereport_gradingmanager', ['id' => $recordid]);
    } else {
        $record = null;
    }

    if ($record == null) {
        redirect($CFG->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string('gradeNotFound', 'gradereport_gradingmanager'), null, \core\notification::ERROR);
    }

    return $record;
}


$record = getRecord($mform);

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string("gradeEditCancel", "gradereport_gradingmanager"));
} else if ($fromform = $mform->get_data()) {


    // Insert the data into database table.
    $recordtoinsert = new stdClass();

    $recordtoinsert->id = $record->id;
    $recordtoinsert->studentname = $fromform->fullname;
    $recordtoinsert->subject = $fromform->subject;
    $recordtoinsert->grade = $fromform->grade;
    $recordtoinsert->timesubmitted = date("d/m/Y H:i", substr(time(), 0, 10));;

//    $DB->update_record(get_string("databaseName", "gradereport_gradingmanager"), $recordtoinsert);

//    redirect($CFG->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string("gradeEditSuccess", "gradereport_gradingmanager"));
} else {
    $mform->set_data(
        array(
            'fullname' => $record->studentname,
            'subject' => $record->subject,
            'grade' => $record->grade,
        )
    );
}

$mform->display();
echo $OUTPUT->footer();
