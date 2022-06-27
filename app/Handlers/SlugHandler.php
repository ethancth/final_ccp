<?php

namespace App\Handlers;

use GuzzleHttp\Client;

use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;

class SlugHandler
{
    public function translate($text)
    {

            return $this->pinyin($text);

    }

    public function pinyin($text)
    {
        return Str::slug(app(Pinyin::class)->permalink($text));
    }
}
