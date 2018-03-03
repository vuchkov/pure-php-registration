<?php

function reg_form()
{
    $promo = new PromoCodes('0');
		require 'templates/reg-form.php';
}

function show_result($post)
{
		$promo = new PromoCodes($post['promocode']);
		$user = new User($post, $promo->score);
		if ($user->approved)
		{
			$page['title'] = 'Success';
			$page['content'] = '<div class="text-success text-center"><h3>Registration completed.</h3><h5>You will receive email confirmation.</div>';
		}
		else
		{
			$page['title'] = 'Unsuccessful';
			$page['content'] = '<div class="text-danger text-center"><h3>Invalid registration.</h3></div>';
		}
		
    require 'templates/layout.php';
}

function confirm_user($hash)
{
	//
}