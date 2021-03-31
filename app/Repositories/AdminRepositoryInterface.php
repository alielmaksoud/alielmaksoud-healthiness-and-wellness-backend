<?php



namespace App\Repositories;

interface AdminRepositoryInterface
{
    public function register($request);
    public function update($request, $id);
    public function login($request);
    public function logout();
    public function profile();
    public function refresh();
    public function createNewToken($token);
}