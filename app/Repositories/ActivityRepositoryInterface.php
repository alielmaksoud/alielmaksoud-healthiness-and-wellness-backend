<?php



namespace App\Repositories;

interface ActivityRepositoryInterface
{
    public function display();
    public function createActivity($request);
    public function update($request, $id);
    public function view($id);
    public function delete($id);
    public function displayItems($itemId);
}