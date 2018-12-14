<?php
/*
This is my solution for the laboration that Niklas Mårdby share on his wiki Porkforge.
I've used this laboration to show my pupils how you can work with PHP in developement.
http://porkforge.mardby.se/index.php?title=PHP_Laboration_3_-_Array_och_loopar
*/

require ('resources/includes/view.php');
require ('resources/includes/model.php');
// Set header correct without using HTML
header("Content-type: text/html; charset=utf-8");

// Get value from url for key page
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_URL);

// Declare variables to avoid problems.
$error = '';
$content = '';

// Run If to check what $page to visit.
// First check if $page is empty.
if(empty($page)) {
	$header = 'Start';
	/*Old way from Beginning--> <div class="content">Long text...</div>*/
    $content = 'Välkommen till hamsterpaj v2 här ska vi återförenas för att komma ihåg då vi catfishade varandra och hatade på varandra anonymt, nu finns det även en flik för er som är lite snuskiga av er så inte barnen behöver läsa det';
    require ('resources/templates/page-template.php');
}

// Check if $page is blog.
elseif($page == 'blogg') {
    $header = 'Blogg';
	$post = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_URL);
	$template = 'all-blog-posts';

	//http://porkforge.mardby.se/index.php?title=PHP_Laboration_3_-_Array_och_loopar#.C3.96vning_4
	//print_r($model);

	// Check if subpage $post is not empty
	if (!empty($post)) {
		//Loop through the $model array and check if the message exists.
		foreach($model as $key => $slug) {
			if ($model[$key]['slug'] == $post) {
				$template = "single-blog-post";
				$title = $model[$key]['title'];
				$author = $model[$key]['author'];
				$date = $model[$key]['date'];
				$message = $model[$key]['text'];
			}
		}
	}

	// If Subpage select is empty give standard page.
	elseif (empty($post)) {}

	// If Subpage select doesn't exists give a standard message.
	else {$error = 'Inlägget finns inte';}

	require ('resources/templates/' . $template . '-template.php');
}

// Check if $page is contacts.
elseif($page == 'kontakt') {
	$header = 'Kontakt';
	/*Old way from Beginning--> <div class="content">Info...</div>*/
    $content = 'Du når oss på skjutensnut@kisskorv.dk';
    require ('resources/templates/page-template.php');
}


// If not any page, 404 message.
else {
	/*echo "Den sökta sidan finns inte";*/
	$header = 'error 404';
	$error = 'Den här sidan finns inte!';
	require ('resources/templates/page-template.php');
}
?>
