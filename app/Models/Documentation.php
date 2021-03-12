<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Exception;
use Parsedown;
use Illuminate\Support\Facades\File;



class Documentation extends Model
{
    use HasFactory;

    public function get($version, $page)
    {

        // dd($this->markdownPath($version, $page));
        if(File::exists($page = $this->markdownPath($version, $page))) {

            return $this->replaceLinks($version, (new Parsedown)->text(File::get($page)));

        }
        throw new Exception('The requested documentation page was not found');
    }


    public function markdownPath($version, $page)
    {

      return  resource_path('docs/'.$version.'/'.$page.'.md');
    }

    public static function versions()
    {
        return [1.0, 1.1];
    }

    protected function replaceLinks($version, $content)
    {
        return str_replace('{{version}}', $version, $content);
    }
}
