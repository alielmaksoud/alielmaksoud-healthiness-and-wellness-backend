<?php



namespace App\Repositories;

interface GenderRepositoryInterface
{
    public function display();
    public function createGender($request);
    public function update($request, $id);
    public function view($id);
    public function delete($id);
    public function displayItems($itemId);
}