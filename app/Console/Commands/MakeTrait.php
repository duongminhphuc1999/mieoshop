<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class MakeTrait extends BaseMakeFile
{
    protected $extension = '.php';

    protected $folderName = 'Traits';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a trait file';

    protected function setFileName(): void
    {
        $this->fileName = $this->argument('fileName');
    }

    protected function generateContent()
    {
        return "<?php        
namespace App\\{$this->folderName};


trait {$this->fileName} 
{

}";
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
