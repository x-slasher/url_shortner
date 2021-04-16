<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUrlRequest;
use App\Http\Requests\UrlRequest;
use App\Http\Requests\UrlWithAuthRequest;
use App\Repositories\Click\ClickRepository;
use App\Repositories\Url\UrlRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;


class UrlController extends Controller
{
    use ResponseTrait;
    private $repository;
    public function __construct(UrlRepository $repository){
        $this->repository = $repository;
    }


    public function generateUrlWithoutAuth(UrlRequest $request) {
        $url = $this->repository->createWithoutAuth($request->all());
        return  $this->withData('Url Shortened Successfully',$this->fullUrl($url->shorten_link));
    }

    public function fullUrl($shortLink) :string {
        return $this->checkLocal().'/'.$shortLink;
    }



    public function generateUrlWithAuth(UrlWithAuthRequest $request){

        $url = $this->repository->createWithAuth($request->all());
        $this->clickRepository->create($url->id);
        return  $this->withData('Url Shortened Successfully',$this->fullUrl($url->shorten_link));
    }

    public function checkLocal() {
        $local =env('APP_URL');;
        if(strpos($local,'localhost')){
            return $local.':8000';
        }else {
            return $local;
        }
    }

    public function getLink(){
        $url = $this->repository->getAllLink();
        return $this->withData('user shortened url list',$url);
    }

    public function updateLink(UpdateUrlRequest $request, $id){
        $url = $this->repository->updateLink($request->all(),$id);
        return $this->withData('url updated',$url);
    }



}
