<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeEnum extends BaseMakeFile
{
    protected $extension = '.php';

    protected $folderName = 'Enums';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:enum {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Enums Folder';

    protected function generateContent()
    {
        return "<?php\n\nnamespace App\\{$this->folderName};\n\nenum {$this->fileName}: int\n{\n    case CASE_1 = 0;\n    case CASE_2 = 0;\n}\n";
    }
}