<?php



namespace App\Repositories;

interface StatusRepositoryInterface
{
    public function display();
    public function create($request);
    public function update($request, $id);
    public function view($id);
    public function delete($id);
}