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
 * Custom custom_csv_export_writer class.
 *
 * @package    gradeexport_apogee
 * @author     Université Clermont Auvergne - Anthony Durif
 * @copyright  2020 Université Clermont Auvergne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class custom_csv_export_writer.
 * Custom child class of csv_export_writer to override functions which need to display some specific datas.
 *
 * @copyright  2020 Université Clermont Auvergne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class custom_csv_export_writer extends csv_export_writer
{
    /**
     * Echos or returns a csv data line by line for displaying.
     *
     * @param bool $return  Set to true to return a string with the csv data.
     * @return string       csv data.
     */
    public function print_csv_data($return = false) {
        fseek($this->fp, 0);
        $returnstring = '';
        while (($content = fgets($this->fp)) !== false) {
            if (!$return){
                // Customization plugin: we ignore the enclosure added for elements with spaces.
                // That should avoid conflicts when we will try to reimport the file in apogee/snw.
                echo str_replace($this->csvenclosure, "", $content);
            } else {
                $returnstring .= $content;
            }
        }
        if ($return) {
            return $returnstring;
        }

    }
}