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

// get database
global $DB;

// page setup
$PAGE->set_url(new moodle_url(get_string('gradesPageUrl', "gradereport_gradingmanager")));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string("gradesTitle", "gradereport_gradingmanager"));


$courseid = $COURSE->id;
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    throw new \moodle_exception('invalidcourseid');
}
require_login($course);
$context = context_course::instance($course->id);

$grades = $DB->get_records(get_string("databaseName", "gradereport_gradingmanager"));

// create template context
$templatecontext = (object)[
    'grades' => array_values($grades),
    'submiturl' => get_string("submitPageUrl", "gradereport_gradingmanager"),
    'editurl' => get_string('editPageUrl', "gradereport_gradingmanager"),
];


// render

echo $OUTPUT->header();

echo $OUTPUT->render_from_template(get_string("gradesTemplate", "gradereport_gradingmanager"), $templatecontext);

echo $OUTPUT->footer();