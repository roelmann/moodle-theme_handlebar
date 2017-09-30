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
 * Links settings page file.
 *
 * @package    theme_handlebar
 * @copyright  2016 Richard Oelmann
 * @copyright  theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/* Links popup Settings */
$page = new admin_settingpage('theme_handlebar_links', get_string('linkspage', 'theme_handlebar'));
$page->add(new admin_setting_heading('theme_handlebar_social', get_string('linkspagesub', 'theme_handlebar'),
        format_text(get_string('linkspagedesc' , 'theme_handlebar'), FORMAT_MARKDOWN)));

$name = 'theme_handlebar/staffsubheading';
$heading = get_string('stafflinks', 'theme_handlebar');
$information = get_string('stafflinksdesc', 'theme_handlebar');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);
for ($i = 1; $i <= 6; $i++) {

    // Staff Link - Name.
    $name = 'theme_handlebar/stafflink' . $i . 'name';
    $title = get_string('stafflink', 'theme_handlebar') . ' ' . $i;
    $description = get_string('stafflinkdesc', 'theme_handlebar');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Staff Link - URL.
    $name = 'theme_handlebar/stafflink' . $i . 'url';
    $title = get_string('stafflinkurl', 'theme_handlebar');
    $description = get_string('stafflinkurldesc', 'theme_handlebar');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $page->add($setting);

    // Staff Link - icon.
    $name = 'theme_handlebar/stafflink' . $i . 'icon';
    $title = get_string('stafflinkicon', 'theme_handlebar');
    $description = get_string('stafflinkicondesc', 'theme_handlebar');
    $default = 'globe';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);
}

$name = 'theme_handlebar/studentsubheading';
$heading = get_string('studentlinks', 'theme_handlebar');
$information = get_string('studentlinksdesc', 'theme_handlebar');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);
for ($i = 1; $i <= 6; $i++) {

    // Student Link - Name.
    $name = 'theme_handlebar/studentlink' . $i . 'name';
    $title = get_string('studentlink', 'theme_handlebar');
    $description = get_string('studentlinkdesc', 'theme_handlebar');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Student Link - URL.
    $name = 'theme_handlebar/studentlink' . $i . 'url';
    $title = get_string('studentlinkurl', 'theme_handlebar');
    $description = get_string('studentlinkurldesc', 'theme_handlebar');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $page->add($setting);

    // Student Link - icon.
    $name = 'theme_handlebar/studentlink' . $i . 'icon';
    $title = get_string('studentlinkicon', 'theme_handlebar');
    $description = get_string('studentlinkicondesc', 'theme_handlebar');
    $default = 'globe';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);
}


// Must add the page after definiting all the settings!
$settings->add($page);
