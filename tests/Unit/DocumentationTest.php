<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\File;
use App\Models\Documentation;

class DocumentationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

     /** @test */
    public function it_gets_the_documentation_page_for_a_given_version()
    {
        File::shouldReceive('exists')->andReturn(true);
        File::shouldReceive('get')->with(resource_path('docs/1.0/example.md'))->andReturn('# Example Page For {{version}}');

        $content = (new \App\Models\Documentation)->get('1.0', 'example');


        $this->assertEquals('<h1>Example Page For 1.0</h1>', $content);
    }


    /** @test */
    public function it_throws_an_exception_if_requested_markdown_file_does_not_exist()
    {
        $this->expectException(\Exception::class);
         (new \App\Models\Documentation)->get('1.0', 'example');
    }

}
