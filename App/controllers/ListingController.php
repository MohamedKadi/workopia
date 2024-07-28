<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;
    public function __construct()
    {

        $config = require basePath('config/db.php');

        $this->db = new Database($config);
    }
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();
        loadView(
            'listings/index',
            [
                'listings' => $listings,
            ]
        );
    }

    public function create()
    {
        loadView('listings/create');
    }

    public function show($params)
    {
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id,
        ];
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        //check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }
        loadView(
            '/listings/show',
            [
                'listing' => $listing
            ]
        );
    }

    public function store()
    {
        $allowedFields = ['title', 'description', 'salary', 'requirements', 'benefits', 'company', 'address', 'city', 'state', 'phone', 'email'];

        $newListData = array_intersect_key($_POST, array_flip($allowedFields));
        $newListData = array_map('sanitize', $newListData);
        $requireFileds = ['title', 'description', 'city', 'state'];

        $errors = [];
        foreach ($requireFileds as $field) {
            if (empty($newListData[$field]) || !Validation::string($newListData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }
        if (!empty($errors)) {
            //Reload view with errors
            loadView(
                'listings/create',
                [
                    'errors' => $errors,
                    'listing' => $newListData
                ]
            );
        }
    }
}
