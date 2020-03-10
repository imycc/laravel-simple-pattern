<?php

namespace LaravelSimpleRepo\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeRepoInterface extends GeneratorCommand
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
    public $bindPlaceholder = '//:end-bindings:';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Binding between Repository and its Interface';

    public function handle() {

        $name = $this->argument('name');

        $provider = \File::get($this->getProviderPath());
        $repositoryInterface = '\\' . $name . "Interface" . "::class";
        \File::put($this->getProviderPath(), 
                   str_replace($this->bindPlaceholder, "\$this->app->bind({$repositoryInterface}, $name);" . PHP_EOL . '        ' . $this->bindPlaceholder, $provider)); 
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getProviderPath()
    {
        return config('lsp.provider.backend');
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

}
