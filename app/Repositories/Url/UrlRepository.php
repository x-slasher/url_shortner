<?php

namespace App\Repositories\Url;

interface UrlRepository {
    public function createWithoutAuth(array $data);
    public function createWithAuth(array $data);
    public function findUrl(string $slug);
    public function getAllLink();
    public function updateLink(array $data, $id);
}
