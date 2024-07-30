<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\Books;
use App\Models\Borrowing;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to ensure that stock_in_use is calculated correctly.
     */
    public function test_book_stock_in_use(): void
    {
        $book = Books::create([
            'code' => 'B001',
            'title' => 'Sample Book',
            'author' => 'Author Name',
            'stock' => 1,
            'published_at' => now(),
        ]);

        Borrowing::create([
            'book_id' => $book->id,
            'member_id' => 1,
            'start_date' => now(),
            'end_date' => date("Y-m-d"),
            'status' => 1,
        ]);

        Borrowing::create([
            'book_id' => $book->id,
            'member_id' => 2,
            'start_date' => now(),
            'end_date' => date("Y-m-d"),
            'status' => 1,
        ]);

        $books = Books::select('*', DB::raw('(SELECT COUNT(*) FROM borrowing WHERE borrowing.book_id = books.id AND borrowing.status = 1) as stock_in_use'))
                      ->where('id', $book->id)
                      ->first();

        $this->assertNotNull($books);
        $this->assertEquals(2, $books->stock_in_use);
    }
}
