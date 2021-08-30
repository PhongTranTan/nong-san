<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Str;

class CreateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Products" ';

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
     * @return mixed
     */
    public function handle()
    {
        $news = Product::latest()->first();
        $number = 0;
        for ($i = 1; $i < 20; $i++) {
            $input = $news->toArray();
            $input['name'] = "{$news->name} $i";
            $input['slug'] = Str::slug("{$news->name} $i", '-');
            Product::create($input);
            $number++;
        }
        $this->info("Create {$number} done !");
    }
}
