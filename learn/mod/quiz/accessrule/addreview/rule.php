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
 * Implementaton of the quizaccess_addreview plugin.
 *
 * @package    quizaccess
 * @subpackage addreview
 * @copyright  2018 Daniel Thies <dethies@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/quiz/accessrule/accessrulebase.php');

/**
 * A rule to allow an attempt after close date submitted immediately for review
 *
 * @copyright  2018 Daniel Thies <dethies@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quizaccess_addreview extends quiz_access_rule_base {

    public static function make(quiz $quizobj, $timenow, $canignoretimelimits) {
        if (empty($quizobj->get_quiz()->addreview) || empty($quizobj->get_quiz()->timeclose)
            || $quizobj->get_quiz()->timeclose > $timenow) {
            return null;
        }

        // Force all review attempts to be abandoned so they do not receive a grade.
        $quizobj->get_quiz()->overduehandling = 'autoabandon';
        return new self($quizobj, $timenow);
    }

    public static function add_settings_form_fields(
            mod_quiz_mod_form $quizform, MoodleQuickForm $mform) {
        $control = $mform->createElement('selectyesno', 'addreview', get_string('addreview', 'quizaccess_addreview'));
        $mform->disabledIf($control, 'timeclose[enabled]');
        $mform->insertElementBefore($control, 'display');
        $mform->addHelpButton('addreview', 'addreview', 'quizaccess_addreview');
    }

    public static function delete_settings($quiz) {
        global $DB;
        $DB->delete_records('quizaccess_addreview', array('quizid' => $quiz->id));
    }

    public static function save_settings($quiz) {
        global $DB;
        if (empty($quiz->addreview)) {
            $DB->delete_records('quizaccess_addreview', array('quizid' => $quiz->id));
        } else {
            if (!$DB->record_exists('quizaccess_addreview', array('quizid' => $quiz->id))) {
                $record = new stdClass();
                $record->quizid = $quiz->id;
                $record->addreview = 1;
                $DB->insert_record('quizaccess_addreview', $record);
            }
        }
    }

    public static function get_settings_sql($quizid) {
        return array(
            'COALESCE(addreview, 0) AS addreview', // Using COALESCE to replace NULL with 0.
            'LEFT JOIN {quizaccess_addreview} qa_ar ON qa_ar.quizid = quiz.id',
            array());
    }


    public function prevent_new_attempt($numprevattempts, $lastattempt) {
        if ($numprevattempts != 0) {
            return get_string('nomoreattempts', 'quizaccess_addreview');
        }
        return false;
    }

    public function description() {
        return get_string('quizclosed', 'quiz', userdate($this->quiz->timeclose)) .
        '<p>' . get_string('reviewattempt', 'quizaccess_addreview', userdate($this->quiz->timeclose));
    }

    public function end_time($attempt) {
        return $attempt->timestart;
    }

    public function get_superceded_rules() {
        return array('openclosedate');
    }
}
