<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportBooksMeta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:book-metadata {--f|file= : CSV file name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import book meta data from csv';

    /**
     * @var string
     */
    protected $fileName = "";
    /**
     * @var bool
     */
    private $skipFirstLine;

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
    public function handle()
    {
        //Call the getter as this will lazy load and check the filename.
        $this->getFileName();
        $this->info("Book meta data import");

        //Confirmation message.
        if (!$this->confirm('Do you really want to import book meta data?')) {
            $this->warn("Import cancelled");
            return 1;
        }
        if ($this->confirm('Does the first line contain headers?')) {
            $this->info("Skipping first line");
            $this->skipFirstLine = true;
        } else {
            $this->skipFirstLine = false;
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
