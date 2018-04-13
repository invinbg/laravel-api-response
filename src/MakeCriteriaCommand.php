<?php

namespace InviNBG\ApiResponse;

use Illuminate\Console\Command;

class MakeCriteriaCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:criteria';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:criteria {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model and transformer class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Criteria';

    public function handle()
    {
        $name = $this->argument('name');
        // Make Model
        $this->call('make:model', ['name' => $name ]);
        // Make Transformer
        $this->call('make:transformer', ['name' => $name.'Transformer']);
    }

}
