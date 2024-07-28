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
        $listings = $this->db->query('SELECT * FROM listings')->fetchAll();
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

    /**
     * Show a listing
     * 
     * @param array $params
     * @return void
     */
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
        $allowedFields = ['title', 'description', 'salary', 'requirements', 'benefits', 'company', 'addresse', 'city', 'state', 'phone', 'email'];

        $newListData = array_intersect_key($_POST, array_flip($allowedFields));
        $newListData = array_map('sanitize', $newListData);

        $newListData['user_id'] = 1;

        $requireFileds = ['title', 'description', 'salary', 'city', 'state'];

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
        } else {
            //submit data
            //"title, description, salary, requirements, benefits, company, address, city, state, phone, email"
            $fields = [];
            foreach ($newListData as $field => $value) {
                $fields[] = $field;
            }
            $fields = implode(', ', $fields);


            //daba value dyalhom
            $values = [];
            foreach ($newListData as $field => $value) {
                if ($value === '') {
                    $newListData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);

            $query = "INSERT INTO listings ({$fields}) VALUES ({$values}) ";

            $this->db->query($query, $newListData);
            $_SESSION['success_message'] = 'listing added successfully';
            header('Location: /listings');
            exit;
        }
    }

    /**
     * Delete a listing
     * 
     * @param array $params
     * @return void
     */
    public function destroy($params)
    {
        $id = $params['id'];
        $params = [
            'id' => $id
        ];
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        //check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', $params);

        //set flash message
        $_SESSION['success_message'] = 'listing deleted successfully';

        header("Location: /listings");
        exit;
    }
}
