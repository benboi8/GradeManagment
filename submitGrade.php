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
require_once('config.php');

global $DB;

// page setup
$PAGE->set_url(new moodle_url('/grade/report/gradingmanager/submitGrade.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Submit grade');

$mform = new submitGradeForm();

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/grade/report/gradingmanager/grades.php', 'Grade submission cancelled.');
} else if ($fromform = $mform->get_data()) {
    // Insert the data into database table.
    $recordtoinsert = new stdClass();
    $recordtoinsert->fullname = $fromform->fullname;
    $recordtoinsert->subject = $fromform->subject;
    $recordtoinsert->grade = $fromform->grade;

    $DB->insert_record($DATABASE_NAME, $recordtoinsert);

    redirect($CFG->wwwroot.'/grade/report/gradingmanager/grades.php', 'Grade submitted.');


}

// render
echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();