<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class createCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        do {
            $name = null;
            do {
                $name = $this->ask('Enter category name');
                if (!$name) {
                    continue;
                }

                break;
            } while (true);

            if (Category::whereName($name)->count()) {
                $this->error('This category already exists!');
                continue;
            }

            Category::create([
                'name' => $name,
            ]);
            $this->info($name . ' has been successfully created!');

            return;
        } while (true);
    }
}
