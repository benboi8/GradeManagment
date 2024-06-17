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
require_once("$CFG->libdir/../repository/lib.php");

class submitGradeForm extends moodleform {
    //Add elements to form
    public function definition(): void
    {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement(
            'text',
            'fullname',
            get_string('fullName', 'gradereport_gradingmanager')
        );
        $mform->setType(
            'fullname',
            PARAM_RAW_TRIMMED
        );
        $mform->addRule(
            'fullname',
            get_string("isRequired", "gradereport_gradingmanager", get_string('fullName', 'gradereport_gradingmanager')),
            'required',
            null,
            'client'
        );
        $mform->addRule(
            'fullname',
            get_string("onlyLetters", "gradereport_gradingmanager", get_string('name', 'gradereport_gradingmanager')),
            'lettersonly',
            null,
            'client'
        );

        $mform->addElement(
            'text',
            'subject',
            get_string('subject', 'gradereport_gradingmanager')
        );
        $mform->setType(
            'subject',
            PARAM_RAW_TRIMMED
        );
        $mform->addRule(
            'subject',
            get_string("isRequired", "gradereport_gradingmanager", get_string('subject', 'gradereport_gradingmanager')),
            'required',
            null,
            'client'
        );
        $mform->addRule(
            'subject',
            get_string("onlyLetters", "gradereport_gradingmanager", get_string('subject', 'gradereport_gradingmanager')),
            'lettersonly',
            null,
            'client'
        );


        $mform->addElement(
            'text',
            'grade',
            get_string('grade', 'gradereport_gradingmanager')
        );
        $mform->setType(
            'grade',
            PARAM_ALPHANUMEXT
        );
        $mform->addRule(
            'grade',
            get_string("isRequired", "gradereport_gradingmanager", get_string('grade', 'gradereport_gradingmanager')),
            'required',
            null,
            'client'
        );

        $maxFiles = 50;
        $maxbytes = get_max_upload_file_size();
        $mform->addElement(
            'filemanager',
            'attachments',
            get_string('attachments', 'gradereport_gradingmanager'),
            null,
            [
                'subdirs' => 0,
                'maxbytes' => $maxbytes,
                'areamaxbytes' => $maxbytes * $maxFiles,
                'maxfiles' => $maxFiles,
                'accepted_types' => ['document', 'presentation', '.txt'],
                'return_types' => FILE_INTERNAL | FILE_EXTERNAL,
            ]
        );

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files): array
    {
        $errors = array();

        if (!is_numeric($data['grade'])) {
            $errors['grade'] = get_string("mustBeNum", "gradereport_gradingmanager", "Grade");
        } else {
            if (0 > $data['grade'] || $data['grade'] > 9) {
                $errors['grade'] = get_string("mustBeBetween", "gradereport_gradingmanager", ['value' => "Grade", 'from' => "0", 'to' => "9"]);
            }
        }
        return $errors;
    }
}
