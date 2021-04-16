<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Click\ClickRepository;
use App\Repositories\Url\UrlRepository;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    private $repository;
    private $clickRepository;
    public function __construct(UrlRepository $repository, ClickRepository $clickRepository)
    {
        $this->repository = $repository;
        $this->clickRepository = $clickRepository;
    }

    public function redirect(string $slug){
        $url = $this->repository->findUrl($slug);
        $this->clickRepository->create($url->id);
        return redirect($url->original_link);
    }
}
