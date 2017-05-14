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
 * FileSettings Lib file.
 *
 * @package    theme_handlebar
 * @copyright  2016 Richard Oelmann
 * @copyright  theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_handlebar_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('handlebar');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'logo')) {
        $theme = theme_config::load('handlebar');
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else if ($filearea === 'headerdefaultimage') { // Default header image.
        return $theme->setting_file_serve('headerdefaultimage', $args, $forcedownload, $options);
    } else if ($filearea === 'backgroundimage') { // Background image.
        return $theme->setting_file_serve('backgroundimage', $args, $forcedownload, $options);
    } else if ($filearea === 'loginimage') { // Login page image.
        return $theme->setting_file_serve('loginimage', $args, $forcedownload, $options);

    } else {
        send_file_not_found();
    }
}

    /**
     * Finds the given setting in the theme from the themes' configuration object.
     * @copyright 2017 theme_handlebar Richard Oelmann https://moodle.org/user/profile.php?id=480148
     * @copyright 2015 Gareth J Barnard - adapted from theme_essential
     * @package    theme_handlebar
     *
     * @param string $setting Setting name.
     * @param string $format false|'format_text'|'format_html'.
     * @return any false|value of setting.
     */
function theme_handlebar_get_setting($setting, $format = false) {
    global $CFG;
    require_once($CFG->dirroot . '/lib/weblib.php');
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('handlebar');
    }
    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}
