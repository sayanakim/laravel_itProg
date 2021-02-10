<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function home()
    {
        return view('home');
    }


    public function about()
    {
        return view('about');
    }


    public function review()
    {
        // выводим все записи из БД на экран
        $reviews = new Contact();
//        dd($reviews->all());
        return view('review', ['reviews'=>$reviews->all()]);
    }

    public function review_check(Request $request)
    {
//        dd($request);
        $valid = $request->validate([
            'email'=>'required|email',
            'subject'=>'required|min:4|max:100',
            'message'=>'required|min:5|max:500'
        ]);

        // помещаем данные в БД
        $review = new Contact();
        $review->email = $request->input('email');
        $review->subject = $request->input('subject');
        $review->message = $request->input('message');
        // сохраняем данные в БД
        $review->save();

        return redirect()->route('review');

//        return view('review');
    }
}
