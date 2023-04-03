<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books',[
            'title'=> 'Cool Book Title',
            'author' => 'Nando',
        ]);

        $response->assertOK();
        $this->assertCount(1, Book::all());

    }

    /** @test  */
public function a_title_is_required() {

    $response = $this->post('/books',[
        'title'=> '',
        'author' => 'Nando',
    ]);

    $response->assertSessionHasErrors('title');

}

    /** @test  */
    public function a_author_is_required() {
        $response = $this->post('/books',[
            'title'=> 'Cool Title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');

    }

    /** @test  */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

         $this->post('/books',[
            'title'=> 'Cool Title',
            'author' => 'Nando',
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id,[
            'title' =>  'New Title',
            'author' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
    }
}
