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

        $this->post('/authors', $this->data());

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
       // $this->assertInstanceOf(Carbon::class, Carbon::parse($author->first()->dob));
        $this->assertEquals('1998/16/09', $author->first()->dob->format('Y/d/m'));
       // $this->assertEquals('1998/16/09', Carbon::parse($author->first()->dob)->format('Y/d/m'));

    }

    /** @test  */
    public function a_name_is_required()
    {
        $response = $this->post('/authors',data: array_merge($this->data(),['name'=>'']));

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function a_dob_is_required()
    {
        $response = $this->post('/authors',data: array_merge($this->data(),['dob'=>'']));

        $response->assertSessionHasErrors('dob');
    }

    public function data()
    {
        return [
            'name' => 'Author Name',
            'dob' => '09/16/1998'
        ];
    }


}
