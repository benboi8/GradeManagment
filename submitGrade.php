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
require_once($CFG->dirroot . '/grade/report/gradingmanager/classes/forms/submitGradeForm.php');

global $DB;

// page setup
$PAGE->set_url(new moodle_url(get_string("submitPageUrl", "gradereport_gradingmanager")));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string("submitTitle", "gradereport_gradingmanager"));

echo $OUTPUT->header();


$mform = new submitGradeForm();

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string("gradeCancelled", "gradereport_gradingmanager"));
} else if ($fromform = $mform->get_data()) {
    // Insert the data into database table.
    $recordtoinsert = new stdClass();

    $recordtoinsert->studentname = $fromform->fullname;
    $recordtoinsert->subject = $fromform->subject;
    $recordtoinsert->grade = $fromform->grade;
    $recordtoinsert->timesubmitted = date("d/m/Y H:i", substr(time(), 0, 10));;

    $DB->insert_record(get_string("databaseName", "gradereport_gradingmanager"), $recordtoinsert);

    redirect($CFG->wwwroot.get_string("gradesPageUrl", "gradereport_gradingmanager"), get_string("gradeSuccess", "gradereport_gradingmanager"));
}




$mform->display();
echo $OUTPUT->footer();
