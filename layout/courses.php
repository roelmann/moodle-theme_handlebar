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
 * A two column layout for the handlebar theme.
 *
 * @package   theme_handlebar
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$preblockshtml = $OUTPUT->blocks('side-pre');
$topblockshtml = $OUTPUT->blocks('side-top');

$blocksslider1html = $OUTPUT->blocksmodal('side-sliderone');
$blocksslider2html = $OUTPUT->blocksmodal('side-slidertwo');
$blocksslider3html = $OUTPUT->blocksmodal('side-sliderthree');
$blocksslider4html = $OUTPUT->blocksmodal('side-sliderfour');

$haspreblocks = strpos($preblockshtml, 'data-block=') !== false;
$hastopblocks = strpos($topblockshtml, 'data-block=') !== false;
$hasslideroneblocks = strpos($blocksslider1html, 'data-block=') !== false;
$hasslidertwoblocks = strpos($blocksslider2html, 'data-block=') !== false;
$hassliderthreeblocks = strpos($blocksslider3html, 'data-block=') !== false;
$hassliderfourblocks = strpos($blocksslider4html, 'data-block=') !== false;

$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $preblockshtml,
    'sidetopblocks' => $topblockshtml,
    'blocksslider1' => $blocksslider1html,
    'blocksslider2' => $blocksslider2html,
    'blocksslider3' => $blocksslider3html,
    'blocksslider4' => $blocksslider4html,
    'haspreblocks' => $haspreblocks,
    'hastopblocks' => $hastopblocks,
    'hasblocksslider1' => $hasslideroneblocks,
    'hasblocksslider2' => $hasslidertwoblocks,
    'hasblocksslider3' => $hassliderthreeblocks,
    'hasblocksslider4' => $hassliderfourblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu)
];

$templatecontext['flatnavigation'] = $PAGE->flatnav;
echo $OUTPUT->render_from_template('theme_handlebar/courses', $templatecontext);

