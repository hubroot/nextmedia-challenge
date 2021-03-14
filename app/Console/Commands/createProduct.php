<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class createProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new product';

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
                $name = $this->ask('Enter product name');
                if (!$name) {
                    continue;
                }

                break;
            } while (true);

            if (Product::whereName($name)->count()) {
                $this->error('This product already exists!');
                continue;
            }

            $descriptio = $this->ask('Enter product description');

            $price = null;
            do {
                $price = $this->ask('Enter product price');
                if ($price && !is_numeric($price)) {
                    continue;
                }
                break;
            } while (true);

            Product::create([
                'name' => $name,
            ]);
            $this->info($name . ' has been successfully created!');

            return;
        } while (true);
    }
}
