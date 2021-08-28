<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\GuidesRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GuidesController extends Controller
{
    protected $guides;

    public function __construct(
        GuidesRepository $guides
    )
    {
        parent::__construct();
        $this->guides = $guides;
    }

    public function getGuidesDetail($slug)
    {
        $guides = $this->guides->findBySlug($slug);
        if(!$guides){
            return abort('404');
        }
        $metadata = $guides->meta;
        $related_guides = $this->guides->getRelated($guides->id);
        return view('frontend.guides.detail', compact('guides', 'related_guides', 'metadata'));
    }
}
