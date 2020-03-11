<?php

namespace LaravelSimpleRepo\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeRepo extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a repository and its interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        if ($this->option('interface')) {
            $this->createInterface();
        }

        if ($this->option('binding')) {
            $this->createBinding();
        }
    }

    /**
     * Create a model interface for the model.
     *
     * @return void
     */
    protected function createInterface()
    {
        $names = Str::studly(class_basename($this->argument('name')));

        $this->call('make:repoInterface', [
            'name' => "{$names}Interface"
        ]);

        return str_replace('DummyRepositoryInterface', "{$names}Interface", null);        
    }


    public function createBinding()
    {
        $names = Str::studly(class_basename($this->argument('name')));

        $this->call('make:binding', [
            'name' => $names
        ]);

        // return str_replace('DummyRepositoryInterface', "{$names}Interface", null);       
    }
 
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        if(!$this->argument('name')) {
            throw new InvalidArgumentException("Missing required argument model name");
        }

        $stub = parent::replaceClass($stub, $name);

        $names = Str::studly(class_basename($this->argument('name')));

        return str_replace('DummyRepository', $names, $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/make-repo.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['interface', 'i', InputOption::VALUE_NONE, 'Generate Repository Interface.'],
            ['binding', 'b', InputOption::VALUE_NONE, 'Binding repository and its interface.'],
        ];
    }
}
