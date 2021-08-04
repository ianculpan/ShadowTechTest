<?php

namespace Tests\Feature;

use App\Models\BooksMeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImportBooksMetaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_throw_an_exception_with_no_file()
    {
        $this->expectException(\Symfony\Component\Console\Exception\RuntimeException::class);
        $this->artisan('import:book-metadata');
    }

    /** @test */
    public function it_will_cancel_an_import()
    {
        $this->artisan('import:book-metadata -f book-meta.csv')
            ->expectsConfirmation('Do you really want to import book meta data?', 'no')
            ->expectsOutput('Import cancelled')
            ->doesntExpectOutput('Book meta data imported')
            ->assertExitCode(1);
    }

    /** @test */
    public function it_will_ask_to_skip_headers()
    {
        $this->artisan('import:book-metadata -f book-meta.csv')
            ->expectsConfirmation('Do you really want to import book meta data?', 'yes')
            ->expectsConfirmation('Does the first line contain headers?', 'yes')
            ->expectsOutput('Skipping first line')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_will_insert_into_the_database()
    {
        $this->artisan('import:book-metadata -f book-meta.csv')
            ->expectsConfirmation('Do you really want to import book meta data?', 'yes')
            ->expectsConfirmation('Does the first line contain headers?', 'yes')
            ->expectsOutput('Book meta data imported');

        $tableName = (new BooksMeta())->getTable();
        $this->assertDatabaseHas($tableName, ['isbn'=> '439023483']);
        $this->assertDatabaseCount($tableName, 99);
    }

}
