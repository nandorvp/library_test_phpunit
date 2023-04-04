<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

   /** @test  */
    public function an_author_can_be_created() {

        $this->post('/authors', [
           'name'=> 'Author Name',
           'dob' => '09/16/1998'
        ]);

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
       // $this->assertInstanceOf(Carbon::class, Carbon::parse($author->first()->dob));
        $this->assertEquals('1998/16/09', $author->first()->dob->format('Y/d/m'));
       // $this->assertEquals('1998/16/09', Carbon::parse($author->first()->dob)->format('Y/d/m'));

    }


}
