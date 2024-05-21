<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // try{
            $rules = [
                'fullName' => 'required|max:255',
                'username' => 'required|max:255|unique:students,username',
                'email' => ['required',
                            'max:255',
                            'regex:/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'
                            ],
                'phone' => 'required|digits:11',
                'address' => 'required|max:255',
                'birthdate' => 'required',
                'imageName' => 'required|image|max:2048|dimensions:min_width=100,min_height=100',
                'password' => ['required',
                                'max:255',
                                'min:8',
                                'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*_])[a-zA-Z0-9!@#$%^&*_]{8,}$/',
                                'confirmed'
                                ],

                'password_confirmation' => 'required|max:255|min:8',
            ];
            $messages = [
                'fullName.required' => __('msg.full_name_required'),
                'fullName.max' => __('msg.full_name_max'),
                'username.required' => __('msg.username_required'),
                'username.max' => __('msg.username_max'),
                'username.unique' => __('msg.username_unique'),
                'email.required' => __('msg.email_required'),
                'email.max' => __('msg.email_max'),
                'email.regex' => __('msg.email_regex'),
                'phone.required' => __('msg.phone_required'),
                'phone.digits' => __('msg.phone_min'),
                'address.required' => __('msg.address_required'),
                'address.max' => __('msg.address_max'),
                'birthdate.required' => __('msg.birthdate_required'),
                'imageName.required' => __('msg.image_name_required'),
                'imageName.max' => __('msg.image_name_max'),
                'password.required' => __('msg.password_required'),
                'password.max' => __('msg.password_max'),
                'password.min' => __('msg.password_error'),
                'password.confirmed' => __('msg.password_confirmed'),
                'password.regex' => __('msg.password_error'),
                'password_confirmation.required' =>__('msg.password_confirmation_required'),
            ];

            $validator = Validator::make($request->all(), $rules,$messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            } else {

                $file_ext = $request->imageName->getClientOriginalName();
                $file_name = time().'_'.$file_ext;
                $path = 'images';
                $request ->imageName -> move($path,$file_name);
                Student::create([
                    'fullName' => $request->fullName,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'birthdate' => $request->birthdate,
                    'imageName' => $file_name,
                    'password' => Hash::make($request->password),
                ]);
            }
        // } catch (\Exception $e) {
        //     return redirect()->back()->with(['fail' => __('msg.Register fail')]);
        // }

        Mail::to('abdoashraf8118@gmail.com') -> send(new ContactUs($request->username, $request->email));

        return redirect()->back()->with(['success' => __('msg.Register Successfully')]);

    }

}

