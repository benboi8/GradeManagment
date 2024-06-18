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
 * Version metadata for the gradereport_gradingManager plugin.
 *
 * @package   gradereport_gradingmanager
 * @copyright 2024, Ben Williams <benboi294@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function grade_report_gradingmanager_extend_navigation_course($navigation, $course, $context) {
    if (has_capability('local/gradesmanager:view', $context)) {
        $url = new moodle_url('/local/gradesmanager/index.php', array('id' => $course->id));
        $navigation->get('grades')->add(get_string('pluginname', 'local_gradesmanager'), $url, navigation_node::TYPE_SETTING, null, 'local_gradesmanager');
    }
}