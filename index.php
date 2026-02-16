<?php 
// This file is part of Moodle - https://moodle.org/
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.
/**
 * List user block.
 *
 * @package     block_list_user
 * @copyright   2026 Renzo Medina <medinast30@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 
require_once(__DIR__ . '/../../config.php');

require_login();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/blocks/list_user/index.php'));
$PAGE->set_title(get_string('pluginname', 'block_list_user'));
$PAGE->set_heading(get_string('pluginname', 'block_list_user'));

$searchform = new \block_list_user\form\search_form();
echo $OUTPUT->header();
$templatedata = [
    'form_search' => $searchform->render(),
    'return_url' => new moodle_url('/my/'),
    'users' => [],
];
echo $OUTPUT->render_from_template('block_list_user/main', $templatedata);
echo $OUTPUT->footer();
