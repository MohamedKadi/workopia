<?php

/**
 * Get the base path
 * 
 * @param string $path
 * 
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;   //ktrj3 full directory dyl file E:\MO COURSES SE\php\PHP From Scratch 2024 Beginner To Advanced\workopia 
}

/**
 * Load a view
 * 
 * @param string $name
 * 
 * @return void
 */
function loadView($name)
{
    require basePath("views/{$name}.view.php");
}

/**
 * Load a partials
 * 
 * @param string $name
 * 
 * @return void
 */
function loadPartials($name)
{
    require basePath("views/partials/{$name}.php");
}
