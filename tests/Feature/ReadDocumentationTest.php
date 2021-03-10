<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;

class ReadDocumentationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function it_assumes_the_latest_documentation_version()
    {
        $this->get('docs/some-page')->assertRedirect('docs/'.DEFAULT_VERSION.'/some-page');
    }

   /** @test */
   public function it_loads_and_parses_a_markdown_documentation_page()
   {
        $this->withoutExceptionHandling();

       app()->instance('App\Models\Documentation', \Mockery::mock('App\Models\Documentation[markdownPath]', function ($mock) {
           $mock->shouldReceive('markdownPath')->once()->andReturn(
               base_path('tests/helpers/stubs/docs/1.0/stub.md')
           );
       }));

       $this->get('docs/'.DEFAULT_VERSION.'/stub')
           ->assertSee('<h1>Stub</h1>')
           ->assertSee('<p>Here is the documentation stub.</p>');
   }
}
