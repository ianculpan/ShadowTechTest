<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:book-data {--f|file= : CSV file name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import book data from csv';

    /**
     * @var string
     */
    protected $fileName = "";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        //Call the getter as this will lazy load and check the filename.
        $this->getFileName();
        $this->info("Book data import");

        //Confirmation message.
        if (!$this->confirm('Do you really want to import book data?')) {
            $this->warn("Import cancelled");
            return 1;
        }

        return 0;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        if (!$this->option('file')) {
            $this->error('You need to supply a file name.');
            throw new \Symfony\Component\Console\Exception\RuntimeException;
        } else {
            $this->setFileName($this->option('file'));
        }
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }
}
