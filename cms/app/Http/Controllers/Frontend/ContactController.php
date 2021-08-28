<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use Carbon\Carbon;
use App\Http\Requests\Frontend\ContactRequest;
use App\Http\Requests\Frontend\SubcribeRequest;
use Mail;

class ContactController extends Controller
{
    protected $contact;

    public function __construct( ContactRepository $contact )
    {
       $this->contact = $contact;
    }

    public function postContact(ContactRequest $rq){
    	$input = $rq->all();
      (isset($input['type'])) ? $type = json_encode($input['type']) : $type = 0;
    	$insert = \DB::table('contact')->insert([
    		'name' => htmlspecialchars($input['name']),
    		'phone' => htmlspecialchars($input['phone']),
    		'email' => htmlspecialchars($input['email']),
    		'message' => htmlspecialchars($input['message']),
    		'type' => $type,
        'project_id' => isset($input['project_id']) ? $input['project_id'] : NULL,
        'other_data' => isset($input['other_data']) ? htmlspecialchars($input['other_data']) : NULL,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);
        $emailContent = 'Name: '.htmlspecialchars($input['name'])."\r\n".'Email: '.htmlspecialchars($input['email'])."\r\n".'Phone: '.htmlspecialchars($input['phone'])."\r\n".'Message: '.htmlspecialchars($input['message']);
        if(!empty($input['other_data'])){
          $emailContent .= "\r\n".'Other: '.htmlspecialchars($input['other_data']);
        }
        try{
          $emailContent = strip_tags($emailContent);
          $contact_type = '';
          if(isset($input['type'])){
            if(in_array(1, $input['type'])){
              $contact_type .= '(Home Loan) ';
            }
            if(in_array(2, $input['type'])){
              $contact_type .= ' (Mortgage Insurance)';
            }
          }
          $subject = 'Contact Mail '.$contact_type;
          $admins = \DB::table('users')->select('email')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', 1)->get();

          foreach($admins as $admin){
            $email = $admin->email;
            Mail::raw($emailContent, function($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
          }
        } catch (Exception $e) {
            throw new MailException('progress.sentMailError');
        }
    	return back()->with('success-contact', 'Your contact has been sent to the system!');
    }

    public function postSubscribe(SubcribeRequest $rq){
      try{
          $input = $rq->all();
          $insert = \DB::table('subscribe')->insertGetId([
            'name' => htmlspecialchars($input['name']),
            'number' => htmlspecialchars($input['number']),
            'email' => htmlspecialchars($input['email']),
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
          $subject = 'Subscribe Mail';
          $email = $input['email'];
          $check = \DB::table('subscribe')->where('id', $insert)->first();
          $input['id'] = $check->id;
          $input['updated_at'] = strtotime($check->updated_at);
          $url = route("admin.subscribe.index");
          $info = [
            'name' => isset($input['name'] ) ? $input['name'] : null,
            'email' => isset($input['email']) ? $input['email'] : null ,
            'phone' => isset($input['number']) ? $input['number'] : null,
          ];
          sendMailAdmin($info,  $subject, $url);
          Mail::send('emails.subscribe', ['info' => $input],function($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
          $data['message'] = 'Subscribe is successful!';
          $data['status'] = 'success';
          return json_encode($data, true);
      } catch (Exception $e) {
          $data['message'] = 'Register Failed !';
          $data['status'] = 'danger';
          return json_encode($data, true);
      }
    }

    public function getUnsubscribe(Request $rq){
      $input = $rq->all();
      $explode = explode("-", $input['code']);
      if($explode != null && count($explode) == 2){
        $id = $explode[0];
        $updated_at = date("Y-m-d H:i:s", $explode[1]);
        $check = \DB::table('subscribe')->where(['email' => $input['email'], 'id' => $id, 'updated_at' => $updated_at])->where('status', 1)->first();
        if($check){
          $subject = 'Unsubscribe Mail';
          $email = $input['email'];
          $update = \DB::table('subscribe')->where('id', $check->id)->update(['status' => 0]);
          $input['email'] = $email;
          $input['id'] = $explode[0];
          $input['updated_at'] = $explode[1];
          Mail::send('emails.unsubscribe', ['info' => $input],function($message) use ($email, $subject) {
              $message->to($email)->subject($subject);
          });
          return redirect()->route('page.home')->with('success', 'You have unsubscribe successfully!');
        }
      }
      return redirect()->route('page.home')->with('failed', 'Failed Unsubscribe!');
    }

    public function getResubscribe(Request $rq){
      $input = $rq->all();
      $explode = explode("-", $input['code']);
      if($explode != null && count($explode) == 2){
        $id = $explode[0];
        $updated_at = date("Y-m-d H:i:s", $explode[1]);
        $check = \DB::table('subscribe')->where(['email' => $input['email'], 'id' => $id, 'updated_at' => $updated_at])->where('status', 0)->first();
        if($check){
          $subject = 'Unsubscribe Mail';
          $email = $input['email'];
          $update = \DB::table('subscribe')->where('id', $check->id)->update(['status' => 1]);
          $input['email'] = $email;
          $input['id'] = $explode[0];
          $input['updated_at'] = $explode[1];
          Mail::send('emails.subscribe', ['info' => $input],function($message) use ($email, $subject) {
              $message->to($email)->subject($subject);
          });
          return redirect()->route('page.home')->with('success', 'You have unsubscribe successfully!');
        }
      }
      return redirect()->route('page.home')->with('failed', 'Failed Unsubscribe!');
    }

    public function scheduleShowflat(Request $rq){
      $input = $rq->all();
      $insert = \DB::table('schedule_showflat')->insert([
        'type' => isset($input['type']) ? 1 : 0,
        'project_id' => isset($input['project_id']) ? htmlspecialchars($input['project_id']) : null,
        'fullname' => isset($input['fullname']) ? htmlspecialchars($input['fullname']) : null,
        'phone' => isset($input['phone']) ? htmlspecialchars($input['phone']) : null,
        'email' => isset($input['m_email2']) ? htmlspecialchars($input['m_email2']) : null,
        'date' => isset($input['date']) ? htmlspecialchars($input['date']) : null,
        'time' => isset($input['time']) ? htmlspecialchars($input['time']) : null,
        'budget' => isset($input['budget']) ? htmlspecialchars($input['budget']) : null,
        'number_of_rooms' => isset($input['number_of_rooms']) ? htmlspecialchars($input['number_of_rooms']) : null,
        'property' => isset($input['property']) ? json_encode($input['property']) : null,
        'message' => isset($input['message']) ? htmlspecialchars($input['message']) : (isset($input['messager']) ? htmlspecialchars($input['messager']) : null),
        'agree' => isset($input['agree']) ? htmlspecialchars($input['agree']) : null
      ]);
      $subject = 'Schedule Tour';
      if(isset($input['m_email2']) && !is_null($input['m_email2'])){
        $subject = 'VVIP Registration';
        $email = $input['m_email2'];
        Mail::send('emails.vip-register', ['info' => $input],function($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });
      }

      if(isset($input['typeVip'])){
        $subject = 'VVIP Registration';
      }

      $info = [
        'name' => isset($input['fullname'] ) ? $input['fullname'] : null,
        'email' => isset($input['m_email2']) ? $input['m_email2'] : null ,
        'phone' => isset($input['phone']) ? $input['phone'] : null,
        'message' => isset($input['message']) ? $input['message'] : null
      ];
      $url = route("admin.schedule.index");
      sendMailAdmin($info,  $subject, $url);
      return back()->with('success-showflat', 'Your showflat has been sent to the system!');
    }
}
