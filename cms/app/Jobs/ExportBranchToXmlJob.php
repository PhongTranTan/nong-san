<?php

namespace App\Jobs;

use App\Models\Branch;
use App\Repositories\BranchRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExportBranchToXmlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
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
    }
}
