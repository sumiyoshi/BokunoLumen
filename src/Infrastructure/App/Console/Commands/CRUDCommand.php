<?php

namespace Infrastructure\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CRUDCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:crud {table} {model}';

    /**
     * @var string
     */
    protected $description = 'Create CRUD class';

    /**
     * @var array
     */
    private $exclusion_columns = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function handle()
    {
        $table = $this->argument('table');
        $model = $this->camel($this->argument('model'));
        $columns = $this->getColumns($table);
        $table_name = $this->camel($table);

        $files = [
            app()->basePath("src/App/Services/{$table_name}Service.php") => $this->makeServiceInterface($model, $table_name),
            app()->basePath("src/Domain/Services/{$table_name}Service.php") => $this->makeService($table_name),
            app()->basePath("src/Domain/Repositories/{$table_name}Repository.php") => $this->makeRepositoryInterface($model, $table_name),
            app()->basePath("src/Infrastructure/Domain/Repositories/Eloquent{$table_name}Repository.php") => $this->makeRepository($model, $table_name),
            app()->basePath("src/Infrastructure/Domain/Models/Eloquent{$model}.php") => $this->makeEloquentModel($model, $table),
            app()->basePath("src/Domain/Models/{$model}.php") => $this->makeModel($model, $columns),

            app()->basePath("tests/repositories/{$table_name}RepositoryTest.php") => $this->makeTestRepository($table_name),
            app()->basePath("tests/services/{$table_name}ServiceTest.php") => $this->makeTestService($table_name)
        ];

        $this->make($files);

        echo "Add route resources(\$app, '{$table}');" . PHP_EOL;
    }

    private function make(array $files)
    {
        foreach ($files as $file_path => $file) {
            if (!file_exists($file_path)) {
                file_put_contents($file_path, $file);
            }
        }
    }

    /**
     * @param $table
     * @return array
     */
    private function getColumns($table)
    {
        $columns = [];
        foreach ($this->getScheme($table) as $row) {
            if ($record = $this->getRecord($row)) {
                $columns[] = $record;
            }
        }

        return $columns;
    }

    /**
     * @param $table
     * @return \PDOStatement
     */
    private function getScheme($table)
    {
        return $this->getPdo()->query("SHOW FULL COLUMNS FROM {$table}");
    }

    private function getRecord($row)
    {
        $_row = $row;
        preg_match("/(.*)\((.*)\)(.*)/is", $_row['Type'], $retArr);
        if ((bool)$retArr) {
            $_row['Type'] = $retArr[1];
            $_row['Size'] = $retArr[2];
        } else {
            $_row['Size'] = '';
        }

        $field = (isset($_row['Field'])) ? $_row['Field'] : null;
        $type = (isset($_row['Type'])) ? $_row['Type'] : null;
        $size = $_row['Size'];

        if (array_search($field, $this->exclusion_columns) !== false) {
            return null;
        }

        return compact('field', 'type', 'size');
    }

    /**
     * @return \PDO
     */
    private function getPdo()
    {
        return DB::connection()->getPdo();
    }

    /**
     * @param $str
     * @return string
     */
    private static function camel($str)
    {
        return strtr(ucwords(strtr($str, ['_' => ' '])), [' ' => '']);
    }

    private function makeService($table_name)
    {
        return <<<EOD
<?php

namespace Domain\Services;

use Domain\Repositories\\{$table_name}Repository;
use Infrastructure\Domain\Services\CRUDService;

class {$table_name}Service extends Service implements \App\Services\\{$table_name}Service
{
    use CRUDService;

    /**
     * @var {$table_name}Repository
     */
    protected \$repo;

    /**
     * {$table_name}Service constructor.
     * @param {$table_name}Repository \$repo
     */
    public function __construct({$table_name}Repository \$repo)
    {
        \$this->repo = \$repo;
    }
}
EOD;
    }

    private function makeServiceInterface($model, $table_name)
    {
        return <<<EOD
<?php

namespace App\Services;

use Domain\Models\\{$model};

interface {$table_name}Service
{
    /**
     * @param \$id
     * @return {$model}
     */
    public function get(\$id);

    /**
     * @param \$options
     *
     * @return {$model}[]
     */
    public function getList(array \$options = []);

    /**
     * @param \$id
     * @return bool
     */
    public function delete(\$id);

    /**
     * @return {$model}
     */
    public function createEntity();

    /**
     * @param \$data
     * @param \$id
     * @return {$model}
     */
    public function save(array \$data, \$id = null);
    
    /**
     * @return array
     */
    public function getErrors();
}
EOD;
    }

    private function makeRepository($model, $table_name)
    {
        return <<<EOD
<?php

namespace Infrastructure\Domain\Repositories;

use Domain\Repositories\\{$table_name}Repository;
use Infrastructure\Domain\Models\Eloquent{$model};

class Eloquent{$table_name}Repository implements {$table_name}Repository
{
    use EloquentCRUDRepository;

    /**
     * @var Eloquent{$model}
     */
    protected \$eloquent;

    /**
     * @param Eloquent{$model} \$eloquent
     */
    public function __construct(Eloquent{$model} \$eloquent)
    {
        \$this->eloquent = \$eloquent;
    }
}
EOD;
    }

    private function makeRepositoryInterface($model, $table_name)
    {
        return <<<EOD
<?php

namespace Domain\Repositories;

use Domain\Models\\{$model};

interface {$table_name}Repository
{
    /**
     * @param \$id
     * @return {$model}
     */
    public function get(\$id);

    /**
     * @param array \$options
     * @return int
     */
    public function getCountList(array \$options);

    /**
     * @param \$options
     *
     * @return {$model}[]
     */
    public function getList(array \$options);

    /**
     * @param \$id
     * @param array \$data
     * @return {$model}
     */
    public function update(\$id, array \$data);

    /**
     * @param array \$data
     * @return {$model}
     */
    public function create(array \$data);

    /**
     * @param \$id
     * @return bool
     */
    public function delete(\$id);

    /**
     * @return {$model}
     */
    public function createEntity();
}
EOD;
    }

    private function makeModel($model, array $columns)
    {


        $list = [];
        foreach ($columns as $column) {
            $field = $column['field'];
            $type = ($column['type'] === 'int') ? 'int' : 'string';

            $list[] = <<<EOD
    /**
     * @var {$type}
     */
    public \${$field};
EOD;
        }

        $property = implode(PHP_EOL.PHP_EOL, $list);

        return <<<EOD
<?php

namespace Domain\Models;

class {$model} extends Model
{
{$property}
}
EOD;
    }

    private function makeEloquentModel($model, $table_name)
    {
        return <<<EOD
<?php

namespace Infrastructure\Domain\Models;

use Domain\Models\\{$model};

class Eloquent{$model} extends EloquentModel
{
    /**
     * @var string
     */
    protected \$table = '{$table_name}';

    protected \$domain_model = {$model}::class;
}
EOD;
    }

    private function makeTestService($table_name)
    {
        return <<<EOD
<?php

use App\Services\\{$table_name}Service;
use Illuminate\Support\Facades\Artisan;

class {$table_name}ServiceTest extends TestCase
{

    /**
     * @var {$table_name}Service
     */
    protected \$service;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        \$this->service = \$this->app->make({$table_name}Service::class);
    }

    public function testGet()
    {
        //
    }

    public function testGetList()
    {
        //
    }

    public function testCreateEntity()
    {
        //
    }

    public function testSaveAndDelete()
    {
        //
    }
}
EOD;
    }

    private function makeTestRepository($table_name)
    {
        return <<<EOD
<?php

use Domain\Repositories\\{$table_name}Repository;
use Illuminate\Support\Facades\Artisan;

class {$table_name}RepositoryTest extends TestCase
{
    /**
     * @var {$table_name}Repository
     */
    protected \$repo;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        \$this->repo = \$this->app->make({$table_name}Repository::class);
    }

    public function testGet()
    {
        //
    }

    public function testCountList()
    {
        //
    }

    public function testList()
    {
        //
    }

    public function testCreateUpdateDelete()
    {
        //
    }

    public function testCreateEntity()
    {
        //       
    }
}
EOD;
    }

}
