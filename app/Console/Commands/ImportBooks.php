<?php

namespace App\Console\Commands;

use App\Models\books;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        if ($this->confirm('Does the first line contain headers?')) {
            $this->info("Skipping first line");
            $this->skipFirstLine = true;
        } else {
            $this->skipFirstLine = false;
        }

        return $this->processInputData() ? 0 : 1;
    }

    private function processInputData(): bool
    {
        if (Storage::disk('local')->exists($this->getFileName())) {
            $fileData = Storage::disk('local')->get($this->getFileName());
            //Unsure as to why the Flysystem does not have a streaming function to read a line.
            //Using this Facade as it is filesystem independent.
            $fileData = explode(PHP_EOL, $fileData);
            foreach ($fileData as $line) {
                if ($this->skipFirstLine) {
                    $this->skipFirstLine = false;
                    continue;
                }
                $this->loadData($line);
            }
        } else {
            $this->error("Import file not found");
            return false;
        }
        $this->info('Book data imported');
        return true;
    }

    private function loadData($line): void
    {
        $data = explode(',', $line);

        if (count($data) == 4) {
            //if we were to collect the field names we would
            // also be able to run a Book::insert($data);
            $book = new books();
            $book->books_count = $data[0];
            $book->isbn = $data[1];
            $book->authors = $data[2];
            $book->original_title = $data[3];
            try {
                $book->saveOrFail();
                $this->info('Record loaded : ' . $data[3]);
            } catch (\Throwable $t) {
                $this->warn('Record not processed ' . $line);
            }
        }
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
