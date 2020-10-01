<?php

namespace App\Http\Controllers\api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ContactController extends Controller
{


    public function store (Request $request) {
        $v = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'name' => 'required',
            'subject' => 'required',
            'phone' => 'required',
            'description' => 'required'
        ]);

        if ($v->fails())
        {
            return response(['required field is missing']);
        }


       $contact =  Contact::create([

            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'description' => $request->description

        ]);


        return response()->json($contact);
    }

}
