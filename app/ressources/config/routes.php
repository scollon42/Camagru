<?php

// All the routes must be written here.
// the $routes array must contains $get array
// and $post array and each routes must be
// written like this :
// 'routes' => 'ControllerName#methodName'

$routes = [

	// Get array
	'get' => $get = [

		'/' => 'Index#home',
		'/signin' => 'User#signIn',
		'/signup' => 'User#signUp',
		'/studio' => 'User#show',
		'/me/logout' => 'User#logout',
		'/me' => 'User#update',
		'/gallery' => 'Gallery#gallery',
		'/gallery/:id' => 'Gallery#showImage'
	],

	// Post array
	'post' => $post = [

		'/signup' => 'User#signUp',
		'/signin' => 'User#signIn',
		'/me' => 'User#update',
		'/me/delete' => 'User#delete',
		'/gallery/:id' => 'Gallery#addComment'
	]
];

?>
