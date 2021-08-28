<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Venue;

class VenueController extends BaseController
{
    public function __construct(
    )
    {
        parent::__construct();
    }

    public function getVenueDetail($venue_id)
    {
        $venue = Venue::find($venue_id);
        return view('frontend.venue.venue_detail', compact('venue'));
    }

}
