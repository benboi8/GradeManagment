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

$string['pluginname'] = 'Grade manager';

$string['gradingmanager:view'] = 'View grades';
$string['gradingmanager:edit'] = 'Edit grades';

$string['gradesPageUrl'] = '/grade/report/gradingmanager/index.php';
$string['gradesTitle'] = 'Grades';
$string['gradesTemplate'] = 'gradereport_gradingmanager/index';

$string['submitPageUrl'] = '/grade/report/gradingmanager/submitGrade.php';
$string['submitTitle'] = 'Submit grade';

$string['editPageUrl'] = '/grade/report/gradingmanager/editGrade.php';
$string['editTitle'] = 'Edit grade';
$string['editTemplate'] = 'gradereport_gradingmanager/edit';

$string['gradeCancelled'] = 'Grade submission cancelled.';
$string['gradeSuccess'] = 'Grade submitted.';

$string['databaseName'] = 'gradereport_gradingmanager';

$string['fullName'] = 'Full name';
$string['name'] = 'Name';
$string['subject'] = 'Subject';
$string['grade'] = 'Grade';
$string['attachments'] = 'Attachments';

$string['isRequired'] = '{$a} is required.';
$string['onlyLetters'] = '{$a} can only contain letters.';
$string['mustBeNum'] = '{$a} must be a number';
$string['mustBeBetween'] = '{$a->value} must be between {$a->from} and {$a->to}';

$string['gradeNotFound'] = 'That grade could not be found.';
$string['gradeEditCancel'] = 'Grade editing cancelled.';
$string['gradeEditSuccess'] = 'Grade edited successfully.';