<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContact;
use App\Contact;
use App\Imports\ContactsImport;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Contact as ContactResource;

class ContactController extends Controller
{

    public function store(StoreContact $request)
    {
        while(true) {
			$vip = 'xxxx-'.rand(1000, 9999).'-'.rand(1000, 9999).'-'.rand(1000, 9999);
            $checkVIP = Contact::where('member_vip_number', $vip)->first();
			if($checkVIP == null) {
				break;
			}
        }

        $input = $request->validated();
        $input['member_vip_number'] = $vip;
        $input['date_registered'] = date('Y-m-d H:i:s');
        $input['date_sync'] = date('Y-m-d H:i:s');
        $input['save_activation_date'] = date('Y-m-d H:i:s');
        $input['status'] = '';
        $input['update_vip_number'] = '';
        $input['subscription'] = 'subscribed';
        
        $contact =  Contact::create($input);
        $contact->info()->create($input);

        return response()->json([
            "msg" => 'Contact saved successfully!',
            "redirectTo" => route('home.source')."?q=".$input["source"],
        ]);
    }

    public function import(){
        $collection = (new ContactsImport)->toArray(request()->file('contacts'));
        
        if(!empty($collection)) {
            $inputs = $collection[0];
            unset($inputs[0]);

            $validator = Validator::make($inputs, [
                '*.0' => 'required|max:55', //full_name
                '*.1' => 'required|email', //email
                '*.2' => 'required', //system_id
                '*.3' => 'required|numeric', //phone_number
                '*.4' => 'required', //date_registered
                '*.5' => 'required', //status
                '*.6' => 'nullable', //sponsored_by
                '*.7' => 'required', //source
                '*.8' => 'required', //birthday
                '*.9' => 'required', //gender
                '*.10' => 'required', //nationality
                '*.11' => 'required', //address
                '*.12' => 'required_with:*.13,*.14,', //company_name
                '*.13' => 'required_with:*.12,*.14,', //company_address
                '*.14' => 'required_with:*.12,*.13,', //position
                '*.15' => 'nullable', //notes
            ]);

            if($validator->passes()) {
                foreach($inputs as $input) {
                    while(true) {
                        $vip = 'xxxx-'.rand(1000, 9999).'-'.rand(1000, 9999).'-'.rand(1000, 9999);
                        $checkVIP = Contact::where('member_vip_number', $vip)->first();
                        if($checkVIP == null) {
                            break;
                        }
                    }
                    
                    $date_registered = ($input[4] - 25569) * 86400;
                    $birthday = ($input[8] - 25569) * 86400;
                    $contact = Contact::create([
                        'member_vip_number' => $vip,
                        'full_name' => $input[0],
                        'email' => $input[1],
                        'system_id' => $input[2],
                        'phone_number' => $input[3],
                        'date_registered' => date('Y-m-d', $date_registered),
                        'status' => $input[5],
                        'sponsored_by' => $input[6],
                        'date_sync' => date('Y-m-d H:i:s'),
                        'save_activation_date' => date('Y-m-d H:i:s'),
                        'source' => $input[7],
                        'update_vip_number' => '',
                        'subscription' => 'subscribed',
                    ]);

                    $contact->info()->create([
                        'birthday' => date('Y-m-d', $birthday),
                        'gender' => $input[9],
                        'nationality' => $input[10],
                        'address' => $input[11],
                        'company_name' => $input[12],
                        'company_address' => $input[13],
                        'position' => $input[14],
                        'notes' => $input[15],
                    ]);
                    $contacts[] = new ContactResource($contact);
                }
                return [
                    'msg' => 'done',
                    'imported' => $contacts
                ];
            } else {
                return response([
                    'errors' => $validator->errors()
                ], 422);
            }
        }
    }
}
