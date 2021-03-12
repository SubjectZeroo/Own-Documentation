<?php

namespace App\Http\Controllers;

use Facades\App\Models\Documentation;
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
        if (! in_array($version, Documentation::versions())) {
            return redirect('docs/'.DEFAULT_VERSION.'/'.$version);
        }

try {
    return view('docs', [
        'content' => Documentation::get($version, $page)
    ]);
} catch (\Exception $e) {
    abort(404, 'The requested documentation was not found');
}


    }
}
