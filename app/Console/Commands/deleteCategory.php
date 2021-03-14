<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class deleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a category by name';

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
            $name = $this->ask('Enter category name to delete');

            $category = Category::whereName($name)->first();

            if (!$category) {
                $this->error("There's no such category with this name!");
                continue;
            }

            $category->delete();
            $this->info($name . ' has been successfully deleted!');

            return;
        } while (true);
    }
}
