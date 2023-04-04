<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Tests\TestCase;

class BookReservationManagement extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {

        $response = $this->post('/books', $this->data());

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());

    }

    /** @test  */
public function a_title_is_required() {

    $response = $this->post('/books', [
        'title' => '',
        'author' => 'Nando'
    ]);

    $response->assertSessionHasErrors('title');

}

    /** @test  */
    public function a_author_is_required() {
        $response = $this->post('/books', array_merge($this->data(), ['author_id' => '']));

        $response->assertSessionHasErrors('author_id');

    }

    /** @test  */
    public function a_book_can_be_updated()
    {

        $this->post('/books',$this->data());

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id,[
            'title' =>  'New Title',
            'author_id' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals(2, Book::first()->author_id);
        $response->assertRedirect($book->path());
    }

    /** @test */
public function a_book_can_be_deleted() {

    $this->post('/books',$this->data());

    $book = Book::first();
    $this->assertCount(1,Book::all());
//    A parte de cima não é necessária, apenas para realmente verificar que adiciona 1 livro e depois elimina. Mas no primeiro
//    teste que fazemos já foi feita a verificação.

    $response = $this->delete($book->path());

    $this->assertCount(0,Book::all());
    $response->assertRedirect('/books');
}

    /** @test  */
    public function a_new_author_is_automatically_added()
    {
        $this->post('/books',[
            'title'=> 'Cool Title',
            'author_id' => 'Nando',
        ]);
        $book = Book::first();

        $author = Author::first();

        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1,Author::all());

    }
    public function data()
    {
        return [
            'title' => 'Cool Book Title',
            'author_id' => 'Nando',
        ];
    }
}
