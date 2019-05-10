<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Resources\Contact as ContactResource;

class HomeController extends Controller
{
    public function index() {
        return view('home.landing');
    }

    public function source(Request $request) {
        $source = $request->q == '(Undefined)' ? "" : $request->q;
        $exists = Contact::where('source', '=', $source)->first() !== null;
        if($exists) {
            return view('home.landing', [
                'source' => $source,
            ]);
        } else {
            return redirect(route('home'));
        }
    }

    public function sourceContacts(Request $request) {
        $source = $request->q == '(Undefined)' ? "" : $request->q;
        $contacts = Contact::where('source', '=', $source)->get();
        if($contacts !== null && !$contacts->isEmpty()) {
            $collection = ContactResource::collection($contacts);
            return $collection;
        } else {
            return response([
                'status' => 'error',
                'msg' => 'Error: source does not exist', 
            ], 400);
        } 
    }
}
