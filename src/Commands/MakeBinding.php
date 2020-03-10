<?php
namespace SimpleRepo\Commands;

/**
 * Class BindingsGenerator
 * @package Prettus\Repository\Generators
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class MakeBinding extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:binding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Binding repository and its interface to service provider.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Binding';

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

        $this->fire();
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {
            $bindingGenerator = new BindingsGenerator([
                'name' => $this->argument('name'),
                'force' => $this->option('force'),
            ]);

            $bindingGenerator->run();
            $this->info($this->type . ' created successfully.');
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }
    }
}