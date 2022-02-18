<?php

declare(strict_types=1);

namespace Zekini\Generics\Tests\Unit;

use Illuminate\Support\Facades\File;
use Zekini\Generics\Tests\TestCase;

class MakeGenericCommandTest extends TestCase
{
    public function testItCreatesANewTestCommand()
    {
        // destination path of the Foo class
        $fooClass = $this->getPath('Commands/TestCommand.php');

        // make sure we're starting from a clean state
        if (File::exists($fooClass)) {
            unlink($fooClass);
        }

        $this->assertFalse(File::exists($fooClass));

        // Run the make command
        $this->artisan('generic:command', [
            'name' => 'TestCommand',
        ]);

        // Assert a new file is created
        $this->assertTrue(File::exists($fooClass));

        //unlink the file
        unlink($fooClass);
    }

    /**
     * Get path to file
     *
     * @param  mixed $name
     * @return string
     */
    protected function getPath($name)
    {
        return __DIR__ . './../../src/' . $name;
    }
}
