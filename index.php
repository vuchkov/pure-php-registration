<?php

require_once('model.php');
require_once('controllers.php');

if (isset($_GET['action']) && ($_GET['action'] == 'show')) {
	show_result($_POST);
} elseif (isset($_GET['action']) && ($_GET['action'] == 'confirm')) {
	confirm_user($_GET['hash']);
} else {
	reg_form();
}