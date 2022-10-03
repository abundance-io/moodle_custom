<?php
require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->libdir.'/filelib.php');
$userid = $userid ? $userid : $USER->id;       // Owner of the page.
echo($userid)
?>

