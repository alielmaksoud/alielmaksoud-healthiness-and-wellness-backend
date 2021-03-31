<?php



namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function display();
    public function createCategory($request);
    public function update($request, $id);
    public function view($id);
    public function delete($id);
    public function displayItems($itemId);
}