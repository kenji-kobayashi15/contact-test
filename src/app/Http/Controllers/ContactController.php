<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()//
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        return view('confirm', ['contact' => $contact]);
    }

    public function store(ContactRequest $request)
    {
        if($request->input('action') === 'back'){
            return redirect()->route('contact.index')->withInput();
        }

        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address1',
            'address2',
            'select_content',
            'content'
        ]);
        Contact::create($contact);
        return view('thanks');
    }


}
