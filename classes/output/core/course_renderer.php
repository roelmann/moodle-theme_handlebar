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
 * Course renderer.
 *
 * @package    theme_handlebar
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_handlebar\output\core;
defined('MOODLE_INTERNAL') || die();

use moodle_url;
use coursecat_helper;
use html_writer;
use lang_string;
use coursecat;
use context_course;

require_once($CFG->dirroot . '/course/renderer.php');

/**
 * Course renderer class.
 *
 * @package    theme_handlebar
 * @copyright  2017 Richard Oelmann
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \theme_boost\output\core\course_renderer {
// Error message when this class is not included, but even if empty it works.

       protected function coursecat_courses(coursecat_helper $chelper, $courses, $totalcount = null) {
         global $CFG;
         $content = '';

        
        $coursecount = 0;
        foreach ($courses as $course) {
            $coursecount ++;


            if ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_EXPANDED) {
                $nametag = 'h3';
            } else {
                $classes .= ' collapsed';
                $nametag = 'div';
            }


            $content .= html_writer::start_tag('div', array('class' => 'courses-block-list'));
            $content .= html_writer::start_tag('div', array('class' => 'card m-b-1 '));

            //Find course image
            $fs = get_file_storage();
            $context = context_course::instance($course->id);
            $files = $fs->get_area_files($context->id, 'course', 'overviewfiles', false, 'filename', false);
            if (count($files)) {
                $overviewfilesoptions = course_overviewfiles_options($course->id);
                $acceptedtypes = $overviewfilesoptions['accepted_types'];
                if ($acceptedtypes !== '*') {
                    // Filter only files with allowed extensions.
                    require_once($CFG->libdir. '/filelib.php');
                    foreach ($files as $key => $file) {
                        if (!file_extension_in_typegroup($file->get_filename(), $acceptedtypes)) {
                            unset($files[$key]);
                        }
                    }
                }
                if (count($files) > $CFG->courseoverviewfileslimit) {
                    // Return no more than $CFG->courseoverviewfileslimit files.
                    $files = array_slice($files, 0, $CFG->courseoverviewfileslimit, true);
                }
            }

            // Get course overview files as images - set $courseimage.
            // The loop means that the LAST stored image will be the one displayed if >1 image file.
            $courseimage = 'theme/'.$this->page->theme->name.'/pix/no_pic.png';
            
            foreach ($files as $file) {
                $isimage = $file->is_valid_image();

                if ($isimage) {
                    $courseimage = file_encode_url("$CFG->wwwroot/pluginfile.php",
                    '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                        $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
                }
            }

           
            $crsimagescss = ' background-image: url("' . $courseimage . '"); background-size: 100% 100%; background-repeat: no-repeat; background-color:#d9d8d8;background-position: center top; height: 200px;';

            $content .= html_writer::start_tag('div', array('style' => $crsimagescss,'class'=>'uceff-moodle-course-image'));
            $content .= html_writer::end_tag('div'); // .image

            //Find name course
            $coursename = $chelper->get_course_formatted_name($course);
            $coursenamelink = html_writer::link(new moodle_url('/course/view.php', array('id' => $course->id)),
                                                $coursename, array('class' => $course->visible ? '' : 'dimmed'));
            $content .= html_writer::tag('h4', $coursenamelink, array('class' => 'h5'));



            // text
            if ($course->has_summary()) {
                $content .= html_writer::start_tag('div', array('class' => 'text-muted'));
                $texto = $chelper->get_course_formatted_summary($course);
                $content .= substr($texto,0,140);
                $content .= (strlen($texto)>140)? '...': '';
                
                $content .= html_writer::end_tag('div'); 
            }  

             // display course contacts. See course_in_list::get_course_contacts()
            if ($course->has_course_contacts()) {
                $content .= html_writer::start_tag('ul', array('class' => 'teachers'));
                foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                    $name = $coursecontact['rolename'].': '.
                            html_writer::link(new moodle_url('/user/view.php',
                                    array('id' => $userid, 'course' => SITEID)),
                                $coursecontact['username']);
                    $content .= html_writer::tag('li', $name);
                }
                $content .= html_writer::end_tag('ul'); // .teachers
            }          

            $content .= html_writer::end_tag('div'); // .col-lg-6
            $content .= html_writer::end_tag('div'); // .card
            
        }

         return $content;
       }

}
