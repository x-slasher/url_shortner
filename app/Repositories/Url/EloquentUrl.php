<?php
namespace  App\Repositories\Url;

use App\Models\Link;
use http\Url;
use Illuminate\Support\Facades\Auth;

class EloquentUrl implements UrlRepository{

    public function createWithoutAuth(array $data)
    {
        $url = new Link;
        $url->original_link = $data['original_link'];
        $url->shorten_link = $this->generateSortLink(8);
        $url->save();
        return $url;
    }

    public function createWithAuth(array $data)
    {
        $url = new Link;
        $url->user_id = $data['user_id'];
        $url->original_link = $data['original_link'];
        $url->shorten_link = !empty($data['shorten_link']) ? $data['shorten_link'] : $this->generateSortLink(8);
        $url->save();
        return $url;
    }

    public function generateSortLink($length){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < $length; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    public function findUrl(string $slug){
        return Link::where('shorten_link',$slug)->first();
    }

    public function getAllLink()
    {
        return Link::with('user','click')->where('user_id',Auth::user()->id)->get();
    }

    public function updateLink(array $data, $id)
    {
        $link = Link::find($id);
        $link->user_id = $data['user_id'];
        $link->original_link = $data['original_link'];
        $link->shorten_link = $data['shorten_link'];
        $link->save();
        return $link;
    }


}
