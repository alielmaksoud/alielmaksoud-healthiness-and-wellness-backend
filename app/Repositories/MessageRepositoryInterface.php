<?php



namespace App\Repositories;

interface MessageRepositoryInterface
{
    public function display();
    public function create($request);
    public function view($id);
    public function delete($id);
}