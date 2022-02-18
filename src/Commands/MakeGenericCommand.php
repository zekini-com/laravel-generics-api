<?php

declare(strict_types=1);

namespace Zekini\Generics\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeGenericCommand extends GeneratorCommand
{
    protected $hidden = true;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generic:command {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates a new zekini-generic command';

    /**
     * Type of class the command creates
     *
     * @var string
     */
    protected $type = Command::class;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        parent::handle();

        //Get the fully qualified class name (FQN)
        $class = $this->qualifyClass($this->getNameInput());

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);

        $content = file_get_contents($path);

        // Update the file content with additional data (regular expressions)

        file_put_contents($path, $content);

        return Command::SUCCESS;
    }

    /**
     * Get the command stub
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . './../../stubs/generic-commands.php.stub';
    }

    /**
     * Gets Default Namespace
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "Zekini\Generics\Commands";
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return __DIR__ . '/../' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * rootNamespace
     */
    protected function rootNamespace()
    {
        return "Zekini\Generics";
    }
}
