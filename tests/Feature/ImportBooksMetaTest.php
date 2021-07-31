<?php

namespace Tests\Feature;

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
        $this->artisan('import:book-metadata -f books.csv')
            ->expectsConfirmation('Do you really want to import book meta data?', 'no')
            ->expectsOutput('Import cancelled')
            ->doesntExpectOutput('Book data imported')
            ->assertExitCode(1);
    }

    /** @test */
    public function it_will_ask_to_skip_headers()
    {
        $this->artisan('import:book-metadata -f books.csv')
            ->expectsConfirmation('Do you really want to import book meta data?', 'yes')
            ->expectsConfirmation('Does the first line contain headers?', 'yes')
            ->expectsOutput('Skipping first line')
            ->assertExitCode(0);
    }

}
