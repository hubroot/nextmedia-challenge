<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class deleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a product by name';

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
            $name = $this->ask('Enter product name to delete');

            $product = Product::whereName($name)->first();

            if (!$product) {
                $this->error("There's no such product with this name!");
                continue;
            }

            $product->delete();
            $this->info($name . ' has been successfully deleted!');

            return;
        } while (true);
    }
}
