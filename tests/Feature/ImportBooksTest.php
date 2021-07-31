<?php

namespace Tests\Feature;

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
}
