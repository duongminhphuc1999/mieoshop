<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class MakeService extends BaseMakeFile
{
    protected $extension = '.php';

    protected $folderName = 'Services';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a service file';

    protected function setFileName(): void
    {
        $this->fileName = $this->argument('fileName').'Service';
    }

    protected function generateContent()
    {
        return "<?php        
namespace App\\{$this->folderName};

use App\Services\BaseModelService;

class {$this->fileName} extends BaseModelService
{

}";
    }

    protected function generateBaseModelServiceContent()
    {
        return '<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
        
abstract class BaseModelService
{
    public function create(Model $model, array $adminData): Model
    {
        return $model->create($adminData);
    }

    public function update(Model $model, array $adminData): bool
    {
        return $model->update($adminData);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function findByField(Model $model, string $field, $value, string $operation = "="): Collection
    {
        return $model->where($field, $operation, $value)->get();
    }

    public function findFirstByField(Model $model, string $field, $value, string $operation  = "=")
    {
        return $model->where($field, $operation, $value)->first();
    }

    public function findById(Model $model, int $value)
    {
        return $model->where("id", $value)->first();
    }
}';
    }

    protected function makeFile()
    {
        $baseModelSerViceFullName = $this->folderPath.'/BaseModelService'.$this->extension;
        if (! file_exists($baseModelSerViceFullName)) {
            $baseModelContent = $this->generateBaseModelServiceContent();

            File::put($baseModelSerViceFullName, $baseModelContent);
        }

        if (file_exists($this->fullFileName)) {
            $this->error('File exists');

            return false;
        }

        $content = $this->generateContent();

        $isSuccess = File::put($this->fullFileName, $content);

        if ($isSuccess) {
            $this->info($this->successMessage.': '.$this->fullFileName);
        }

        return $isSuccess;
    }
}