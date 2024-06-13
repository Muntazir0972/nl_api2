<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ContactFormController extends Controller
{
     // Store Contact Form data
     public function NewsForm(Request $request)
     {
         // Form validation
         $validator = Validator::make($request->all(), [
             'email' => 'required|email',
             // You can add additional validation rules here if needed
         ]);
 
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 400);
         }
 
         // Send mail to Application Admin
         Mail::send('emails.contact', ['email' => $request->input('email')], function ($message) use ($request) {
             $message->from($request->input('email'));
             $message->to('mohammadmuntazir18@gmail.com', 'Admin')->subject('Newsletter Subscription');
         });
 
         return response()->json(['success' => 'The email has been sent.']);
     }

    
}
