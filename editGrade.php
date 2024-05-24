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
global $CFG;

// page setup
$PAGE->set_url(new moodle_url(get_string("editPageUrl", "gradereport_gradingmanager")));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string("editTitle", "gradereport_gradingmanager"));

$mform = new editGradeForm();

function getRecord($form, $db, $cfg) {

    $fromform = $form->get_data();

    $recordid = null;

    if ($fromform != null) {
        // if hidden element has id
        if ($fromform->studentid != null) {
            // set id to that id
            $recordid = $fromform->studentid;
        }
    }
    // if $fromform is null then data does not exist in form
    if ($recordid == null) {
        // otherwise get the id from url
        if (array_key_exists('id', $_GET)) {
            $recordid = $_GET['id'];
            // set hidden element to id for when page refreshes
            $form->set_data(array('studentid' => $recordid));
        } else {
            redirect($cfg->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string('gradeNotFound', 'gradereport_gradingmanager'), null, \core\notification::ERROR);
        }
    }


    if ($db->record_exists("gradereport_gradingmanager", array("id" => $recordid))) {
        $record = $db->get_record('gradereport_gradingmanager', ['id' => $recordid]);
    } else {
        redirect($cfg->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string('gradeNotFound', 'gradereport_gradingmanager'), null, \core\notification::ERROR);
    }

    return $record;
}


$record = getRecord($mform, $DB, $CFG);

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

    $DB->update_record(get_string("databaseName", "gradereport_gradingmanager"), $recordtoinsert);

    redirect($CFG->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string("gradeEditSuccess", "gradereport_gradingmanager"));
} else {
    $mform->set_data(
        array(
            'fullname' => $record->studentname,
            'subject' => $record->subject,
            'grade' => $record->grade,
        )
    );
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
