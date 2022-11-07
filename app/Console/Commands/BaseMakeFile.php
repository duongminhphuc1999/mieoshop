<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BaseMakeFile extends Command
{
    protected $extension = '.txt';

    protected $fileName = '';

    protected $folderName = '';

    protected $folderPath = '';

    protected $successMessage = 'Success create file';

    // protected $fileName = "";
    // protected $fileName = "";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:file {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new console command instance.
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
        try {
            $this->setFileName();
            $this->setFolderPath();
            $this->setFullFileName();
            $this->makeFolderIfNotExists();
            $this->makeFile();
        } catch (\Throwable $th) {
            $this->info($th->getMessage());
        }
    }

    protected function setFileName(): void
    {
        $this->fileName = ucfirst($this->argument('name'));
    }

    protected function setFolderPath()
    {
        $this->folderPath = empty($this->folderName) ? app_path() : app_path($this->folderName);
    }

    protected function makeFolderIfNotExists()
    {
        if (!file_exists($this->folderPath)) {
            mkdir($this->folderPath, 0777, true);
        }
    }

    protected function setFullFileName()
    {
        $this->fullFileName = $this->folderPath . '/' . $this->fileName . $this->extension;
    }

    protected function generateContent()
    {
        return '';
    }

    protected function makeFile()
    {
        if (file_exists($this->fullFileName)) {
            $this->error('File exists');

            return false;
        }

        $content = $this->generateContent();

        $isSuccess = File::put($this->fullFileName, $content);

        if ($isSuccess) {
            $this->info($this->successMessage . ': ' . $this->fullFileName);
        }

        return $isSuccess;
    }
}
