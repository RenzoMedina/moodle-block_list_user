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
$searchfield = optional_param('searchfield', 'firstname', PARAM_TEXT);
$searchvalue = optional_param('search', '', PARAM_TEXT);
$download = optional_param('download', '', PARAM_TEXT);
$params = [
    'deleted'=>0,
    'suspended' => 0,
];
$page = optional_param('page', 0, PARAM_INT);
$perpage = 10;
$offset = $page * $perpage;
$countsql = "SELECT COUNT(id) FROM {user} WHERE deleted = :deleted AND suspended = :suspended";
$sql = "SELECT id, firstname, lastname, email FROM {user} WHERE deleted = :deleted AND suspended = :suspended";
if (!empty($searchvalue)) {
    $searchcondition = " AND " . $DB->sql_like($searchfield, ':search', false);
    $sql .= $searchcondition;
    $countsql .= $searchcondition;
    $params['search'] = '%' . $DB->sql_like_escape($searchvalue) . '%';
}

$sql .= " ORDER BY firstname ASC, lastname ASC";
$users = $DB->get_records_sql($sql, $params, $offset, $perpage);
$totalusers = $DB->count_records_sql($countsql, $params);
$paginationhtml = '';
if ($totalusers > $perpage) {
    $baseurl = new moodle_url('/blocks/list_user/index.php',['search' => $searchvalue, 'searchfield' => $searchfield]);
    $pagingbar = new paging_bar($totalusers, $page, $perpage, $baseurl, 'page');
    $paginationhtml = $OUTPUT->render($pagingbar);
}
if (!empty($download)) {
    $validformats = ['csv', 'excel', 'ods'];
    if (!in_array($download, $validformats)) {
        $download = 'csv';
    }
    $users = $DB->get_records_sql($sql, $params);
    $exportdata = [];
    foreach ($users as $user) {
        $exportdata[] = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'idnumber' => $user->idnumber ?? '',
            'username' => $user->username,
        ];
    }
    $columns = [
        'firstname' => get_string('firstname'),
        'lastname' => get_string('lastname'),
        'email' => get_string('email'),
        'idnumber' => get_string('idnumber'),
        'username' => get_string('username'),
    ];
    $filename = 'users_' . date('Ymd');
    \core\dataformat::download_data($filename, $download, $columns, $exportdata);
    exit;
}
$templatedata = [
    'form_search' => $searchform->render(),
    'return_url' => new moodle_url('/my/'),
    'users' => array_values($users),
    'haspagination' => !empty($paginationhtml),
    'pagination' => $paginationhtml,
    'download_file' => (new moodle_url('/blocks/list_user/index.php',[
        'search' => $searchvalue,
        'searchfield' => $searchfield,
        'download' => 'excel',
        ]))->out(false),
];
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('block_list_user/main', $templatedata);
echo $OUTPUT->footer();
