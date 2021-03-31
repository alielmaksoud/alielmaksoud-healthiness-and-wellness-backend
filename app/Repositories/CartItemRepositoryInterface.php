<?php



namespace App\Repositories;

interface CartItemRepositoryInterface
{
    public function display();
    public function create($request);
    public function view($id);
    public function delete($id);
}