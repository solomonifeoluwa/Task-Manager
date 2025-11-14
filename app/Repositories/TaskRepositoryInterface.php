<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function getByProject($projectId);
    public function create(array $data);
    public function update($task, array $data);
    public function delete($task);
    public function reorder(array $orderedIds);
}
