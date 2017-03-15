<?php

function custom_login_logo() {
	echo '<style type="text/css">h1 {height: 200px; margin-bottom: 0 !important;  } h1 a { background: url('.get_bloginfo('template_directory').'/img/logo-admin.png) 50% 50% no-repeat !important; display: block; height: 200px !important; width: 100% !important}</style>';
}

add_action('login_head', 'custom_login_logo');
