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

require_once("$CFG->libdir/formslib.php");

class submitGradeForm extends moodleform {
    //Add elements to form
    public function definition(): void
    {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'fullname', 'Full name');
        $mform->setType('fullname', PARAM_ALPHAEXT);
        $mform->setDefault('fullname', 'Please your full name');

        $mform->addElement('text', 'subject', 'Subject');
        $mform->setType('subject', PARAM_ALPHANUMEXT);
        $mform->setDefault('subject', 'Please the subject');

        $mform->addElement('text', 'grade', 'Grade');
        $mform->setType('grade', PARAM_INT);
        $mform->setDefault('grade', 'Please the grade between 0-9');

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files): array
    {
        var_dump($data, $files);
        return array();
    }
}
