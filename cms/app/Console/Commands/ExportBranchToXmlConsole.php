<?php

namespace App\Console\Commands;

use App\Models\Branch;
use Illuminate\Console\Command;

class ExportBranchToXmlConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:branch_2_xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export branch to XML to show on Map';

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
        $branchs = Branch::select("*",
            \DB::raw('IF(type = "head_office", 1, IF(type = "distribution_center", 2, IF(type = "store", 3, IF(type = "supermarket", 4, 5)))) as sort_type')
        )->with(['children'])
            ->where('parent_id', 0)
            ->orderBy('sort_type', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $locales = \LaravelLocalization::getSupportedLanguagesKeys();

        foreach ($locales as $key) {
            $locale = $key;
            $render = view('frontend.network.partials.export_xml', compact('branchs', 'locale'))->render();
            \File::put( public_path("assets/locations/{$locale}/network_data.xml"), $render);
        }

        echo 'Done';
    }
}
