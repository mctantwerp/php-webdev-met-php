<?php
    include('./functions/helpers.php');

    if(strpos($_SERVER['SERVER_SOFTWARE'], 'nginx') !== false)
    {
        $array = explode('/', $_SERVER['REQUEST_URI']);
        $array = array_filter($array);
        $array = array_map(fn($value) => strtok($value, '?'), $array);
        $array = array_map('urlencode', $array);

        $_GET['lang'] = $array[1] ?? 'nl';
        $_GET['p'] = $array[2] ?? '';
    }

	error_reporting(0);

	/*
	 * Set page
     */
	$page = (empty($_GET['p'])) ? 'home' : $_GET['p'];

	/*
	 * Set redirect where needed
     */
	if(!file_exists('./pages/'. $page .'.php')) { header('Location: /'); }

    $headerStyles = [
        'home' => '',
        'about' => 'style-two',
        'blog-detail' => 'style-three',
        'blog' => 'style-three',
        'contact' => 'style-three',
        'project-details' => 'style-three',
        'project' => 'style-three',
        'service-detail' => 'style-three',
        'service' => '',
    ];

    $lang = match($_GET['lang']) {
        'fr' => 'fr',
        'en' => 'en',
        default => 'nl',
    };

    $res = include "resources/{$lang}.php";
?>
