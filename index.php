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
 * Main page of the plugin, displays form.
 *
 * @package    gradeexport_apogee
 * @author     Anthony Durif - Université Clermont Auvergne
 * @copyright  2019 Anthony Durif - Université Clermont Auvergne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/grade/export/lib.php');
require_once($CFG->dirroot . '/enrol/locallib.php');
require_once('grade_export_apogee.php');
require_once('grade_export_apogee_form.php');

$id = required_param('id', PARAM_INT);
$course = get_course($id);

$PAGE->set_url('/grade/export/apogee/index.php', array('id' => $id));

if (!$course) {
    print_error('invalidcourseid');
}

require_login($course);
$context = context_course::instance($id);
$manager = new course_enrolment_manager($PAGE, $course);

require_capability('moodle/grade:export', $context);
require_capability('gradeexport/apogee:view', $context);

print_grade_page_head($COURSE->id, 'export', 'apogee', get_string('exportto', 'grades') . ' ' . get_string('pluginname', 'gradeexport_apogee'));
export_verify_grades($COURSE->id);

$actionurl = new moodle_url('/grade/export/apogee/export.php', array('id' => $course->id));

$mform = new grade_export_apogee_form($actionurl);

$mform->display();

echo $OUTPUT->footer();