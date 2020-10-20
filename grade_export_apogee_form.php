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
 *
 * @package    gradeexport_apogee
 * @author     Anthony Durif - Université Clermont Auvergne
 * @copyright  2019 Anthony Durif - Université Clermont Auvergne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

/**
 * grade_export_apogee_form class, used to determine which grade item export and for which students.
 *
 * @package    gradeexport_apogee
 * @copyright  2019 Anthony Durif - Université Clermont Auvergne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_export_apogee_form extends moodleform
{
    /**
     * Form definition.
     */
    public function definition() {
        global $CFG, $COURSE;
        $mform = $this->_form;

        $mform->addElement('header', 'gradeitems', get_string('gradeitemsinc', 'grades'));

        $switch = grade_get_setting($COURSE->id, 'aggregationposition', $CFG->grade_aggregationposition);
        $gseq = new grade_seq($COURSE->id, $switch);

        if ($gradeitems = $gseq->items) {
            $default = 0;
            $canviewhidden = has_capability('moodle/grade:viewhidden', context_course::instance($COURSE->id));

            foreach ($gradeitems as $gradeitem) {
                // Is the grade_item hidden or its deletion pending? If so, can the user see hidden grade_items?
                $deletionpending = course_module_instance_pending_deletion($COURSE->id, $gradeitem->itemmodule, $gradeitem->iteminstance);
                if (($gradeitem->is_hidden() && !$canviewhidden) || $deletionpending) {
                    continue;
                }

                $radioarray[] =& $mform->createElement('radio', 'item', '', $gradeitem->get_name(), $gradeitem->id);

                if ($gradeitem->itemtype == "course") {
                    $default = $gradeitem->id;
                }
            }

            $mform->addGroup($radioarray, 'items', '', array('<br/>'), false);
            $mform->addRule('items', null, 'required', null, 'client');
            if ($default != 0) {
                $mform->setDefault('item', $default);
            }
        }

        $mform->addElement('header', 'source', get_string('apogee:source_file', 'gradeexport_apogee'));

        $link = html_writer::link(new moodle_url('example.csv'), 'example.csv');
        $mform->addElement('static', 'examplecsv', get_string('apogee:examplecsv', 'gradeexport_apogee'), $link);
        $mform->addHelpButton('examplecsv', 'apogee:examplecsv', 'gradeexport_apogee');

        $mform->addElement('filepicker', 'importfile', get_string('apogee:select_file', 'gradeexport_apogee'), null, array(
            'maxbytes' => 0,
            'accepted_types' => array('.csv'),
            'trusttext' => false,
        ));
        $mform->addHelpButton('importfile', 'apogee:select_file', 'gradeexport_apogee', '', null);
        $mform->addRule('importfile', null, 'required', null, 'client');

        $delimiterslist = ['semicolon' => ';', 'comma' => ',', 'tab' => '/t'];
        $mform->addElement('select', 'delimiter', get_string('apogee:delimiter', 'gradeexport_apogee'), $delimiterslist);
        $mform->addHelpButton('delimiter', 'apogee:delimiter', 'gradeexport_apogee');
        $mform->setDefault('delimiter', 'semicolon');

        $this->add_action_buttons();
    }
}
