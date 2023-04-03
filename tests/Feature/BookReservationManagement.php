<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Tests\TestCase;

class BookReservationManagement extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {

        $response = $this->post('/books',[
            'title'=> 'Cool Book Title',
            'author' => 'Nando',
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());

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
        $response->assertRedirect($book->path());
    }

    /** @test */
public function a_book_can_be_deleted() {

    $this->post('/books',[
        'title'=> 'Cool Title',
        'author' => 'Nando',
    ]);

    $book = Book::first();
    $this->assertCount(1,Book::all());
//    A parte de cima não é necessária, apenas para realmente verificar que adiciona 1 livro e depois elimina. Mas no primeiro
//    teste que fazemos já foi feita a verificação.

    $response = $this->delete($book->path());

    $this->assertCount(0,Book::all());
    $response->assertRedirect('/books');
}
}
