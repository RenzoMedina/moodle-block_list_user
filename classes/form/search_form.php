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
 * Form for searching users in the list_user block.
 *
 * @package     block_list_user
 * @copyright   2026 Renzo Medina <medinast30@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 

namespace block_list_user\form;
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');
class search_form extends \moodleform {
    /**
     * Defines the form elements.
     */
    public function definition() {
        $mform = $this->_form;

        $options = [
            'firstname' => get_string('firstname'),
            'lastname' => get_string('lastname'),
            'email' => get_string('email'),
            'idnumber' => get_string('idnumber'),
            'username' => get_string('username'),
        ];
        $mform->addElement('select', 'searchfield', get_string('searchby', 'block_list_user'), $options);
        $mform->addElement('text', 'search', get_string('searchusers', 'block_list_user'));
        $mform->setType('search', PARAM_TEXT);
        $this->add_action_buttons(false, get_string('search', 'block_list_user'));
    }
}