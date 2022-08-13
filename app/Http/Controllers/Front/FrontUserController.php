<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Sms;
use Auth;
use Session;
use Illuminate\Support\Facades\Mail;
class FrontUserController extends Controller
{
    public function login_register()
    {
        return view('front.auth.login_register');
    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $userCount = User::where('email',$data['email'])->count();
        if($userCount > 0){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function registerUser(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            $userCount = User::where('email',$data['email'])->count();
            if($userCount > 0){
                $error_message = 'Email already exists!';
                session::flash('error_message',$error_message);
                return redirect()->back();
            }else{
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                    //echo '<pre></pre>'; print_r(Auth::user()); die;
                    if(Session::get('session_id')){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id' => $user_id]);
                    }
                    //send register sms
                    // $message = 'Dear customer, you have been successfully registered with e-com website. Login to your account access orders and available offers';
                    // $mobile = $data['mobile'];
                    // Sms::sendSms($message,$mobile);

                    //send registered email
                    // $email = $data['email'];
                    // $messageData = ['name' => $data['name'],'mobile' =>$data['mobile'],'email' => $data['email']];
                    // Mail::send('front.emails.register',$messageData,function($message) use ($email){
                    //     $message->to($email)->subject('Welcome e-commerce website');
                    // });
                    return redirect('cart');
                }
            }
        }
    }

    public function userLogin(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                //update user cart with user_id
                if(Session::get('session_id')){
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id',$session_id)->update(['user_id' => $user_id]);
                }
                return redirect('cart');
            }else{
                $error_message = 'Invalid email or password';
                session::flash('error_message',$error_message);
                return redirect()->back();
            }
        }
    }

    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetail = User::find($user_id)->toArray();
        //dd($userDetail);
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            $success = 'Your account Detail has been updated successfully!';
            Session::put('success',$success);
            session::forget('error_message');
            
            return redirect()->back();
        }
        return view('front.auth.account')->with(compact('userDetail'));
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
