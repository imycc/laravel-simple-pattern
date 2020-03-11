<?php

namespace LaravelSimpleRepo\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeBinding extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:binding';

    /**
     * The placeholder for repository bindings
     *
     * @var string
     */
    public $bindPlaceholder = '//end-binding';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Bindings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Binding between Repository and its Interface';

    public function handle() {

        $name = $this->argument('name');

        $provider = \File::get($this->getProvidersPath());
        $repositoryInterface = 'App\Repositories'.'\\' . $name . "Interface" . "::class";
        $repository = 'App\Repositories'. '\\' . $name . "::class";
        \File::put($this->getProvidersPath(), 
                   str_replace($this->bindPlaceholder, "\$this->app->bind($repositoryInterface, $repository);" . PHP_EOL . '        ' . $this->bindPlaceholder, $provider)); 
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getProvidersPath()
    {
        return $this->getBasePath() . '/Providers/' . 'BackendServiceProvider' . '.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return config('lsp.providers.basePath', app()->path());
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/make-binding.stub';
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        $name = $this->argument('name');

        $repositoryInterface = '\\' . $name . "Interface" . "::class";
        $repository = '\\' . $name . "::class";

        return array_merge(parent::getReplacements(), [
            'repositoryinterface' => $repositoryInterface,
            'repository' => $repository,
            'placeholder' => $this->bindPlaceholder,
        ]);
    }

}
