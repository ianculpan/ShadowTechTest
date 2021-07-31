<?php

namespace Tests\Feature;

use App\Models\books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImportBooksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_throw_an_exception_with_no_file()
    {
        $this->expectException(\Symfony\Component\Console\Exception\RuntimeException::class);
        $this->artisan('import:book-data');
    }

    /** @test */
    public function it_will_cancel_an_import()
    {
        $this->artisan('import:book-data -f books.csv')
            ->expectsConfirmation('Do you really want to import book data?', 'no')
            ->expectsOutput('Import cancelled')
            ->doesntExpectOutput('Book data imported')
            ->assertExitCode(1);
    }

    /** @test */
    public function it_will_ask_to_skip_headers()
    {
        $this->artisan('import:book-data -f books.csv')
            ->expectsConfirmation('Do you really want to import book data?', 'yes')
            ->expectsConfirmation('Does the first line contain headers?', 'yes')
            ->expectsOutput('Skipping first line')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_will_insert_into_the_database()
    {
        $this->artisan('import:book-data -f books.csv')
            ->expectsConfirmation('Do you really want to import book data?', 'yes')
            ->expectsConfirmation('Does the first line contain headers?', 'yes')
            ->expectsOutput('Book data imported');

        $tableName = (new Books())->getTable();
        $this->assertDatabaseHas($tableName, ['isbn'=> '439023483']);
        $this->assertDatabaseCount($tableName, 67);
    }

}
