<?php



namespace App\Repositories;

interface UserRepositoryInterface
{
    public function register($request);
    public function login($request);
    public function logout();
    public function profile();
    public function refresh();
    public function createNewToken($token);
    public function display();
    public function delete($id);
    public function view($id);
    public function update($request, $id);
}