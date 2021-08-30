<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use Carbon\Carbon;
use App\Http\Requests\Frontend\ContactRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
class ContactController extends Controller
{
    protected $contact;

    public function __construct(ContactRepository $contact )
    {
       $this->contact = $contact;
    }

    public function postContact(ContactRequest $rq){
    	$input = $rq->all();
    	$data = [
    		'name' => htmlspecialchars($input['name']),
    		'phone' => htmlspecialchars($input['phone']),
    		'email' => htmlspecialchars($input['email']),
    		'message' => htmlspecialchars($input['message']),
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	];
        dd(1);
        Contact::create($data);
    	// return back()->with('success-contact', 'Cám ơn đã liên hệ');
        $status = 'success';
    	return $status;
    }
}
