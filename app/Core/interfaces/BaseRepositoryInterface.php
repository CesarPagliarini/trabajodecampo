<?php


namespace App\Core\interfaces;


interface BaseRepositoryInterface
{


    public function create(array  $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}
