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
 * @param array $data
 * 
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");
    //if ktchecki $name dyl path li 3titiha wach kyna endk f dossier view ola la
    if (file_exists($viewPath)) {
        extract($data); //kikhli array associative i creayi variables meaha data
        require $viewPath;
    } else {
        echo "View '{$name} not found";
    }
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
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial '{$name} not found";
    }
}

/**
 * inspect a value(s)
 * 
 * @param  mixed $variable
 * @return void
 */
function inspect($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '<pre>';
}

/**
 * inspect a value(s)
 * 
 * @param  mixed $variable
 * @return void
 */
function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '<pre>';
}

/**
 * Format salary
 * 
 * @param string $salary
 * @return string $formatted Salary
 */
function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}
