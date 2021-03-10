<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{

    protected $docs;

    public function __construct(Documentation $docs)
    {
        $this->docs = $docs;
    }


    public function show($version, $page = '')
    {
        if (! in_array($version, [1.0, 1.1])) {
            return redirect('docs/'.DEFAULT_VERSION.'/'.$version);
        }


    //   $content =  $this->docs->get($version, $page);

    //   return $content;
      return view('docs', [
          'content' => $this->docs->get($version, $page)
      ]);
    }
}
