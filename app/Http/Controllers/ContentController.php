<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use App\Http\Traits\ResponseTrait;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContentController extends Controller
{
    use ResponseTrait;

    // Slides Function 
    public function showSlide(Request $request, $slideNumber)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);

        // If Coming From Cover Page
        if ($slideNumber == 1) {
            $book = Book::where('user_id', $loginUserId)->first('designed_for');
            if ($book == null || empty($book)) {
                return redirect()->back()->withErrors('Please add proper data first.');
            }
        }
        if ($user->page_number >= $slideNumber) {
            return view('pages.slide' . $slideNumber);
        } else {
            User::where('id', $loginUserId)->update(['page_number' => $slideNumber]);
            return redirect()->route('slide', ['slideNumber' => $slideNumber]);
        }
    }

    // Gratitude FUnction 
    public function gratitudeFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);

        if ($user->page_number >= 7) {
            return view('pages.gratitude');
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 7]);
            return redirect('/gratitude');
        }
    }

    // WOW FUnction 
    public function wowFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);

        if ($user->page_number >= 8) {
            return view('pages.wow');
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 8]);
            return redirect('/wow');
        }
    }

    // vision FUnction 
    public function visionFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);

        if ($user->page_number >= 9) {
            return view('pages.vision');
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 9]);
            return redirect('/vision');
        }
    }

    // inspiration FUnction 
    public function inspirationFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);

        if ($user->page_number >= 10) {
            return view('pages.inspiration');
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 10]);
            return redirect('/inspiration');
        }
    }

    // execution FUnction 
    public function executionFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);

        if ($user->page_number >= 11) {
            return view('pages.execution');
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 11]);
            return redirect('/execution');
        }
    }

    // Show Cover Page
    public function coverPage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.cover', compact('book'));
    }

    // submit cover FUnction 
    public function submitCover(Request $request)
    {
        $loginUserId = Auth::user()->id;
        if ($request->has('book_id') && $request->book_id != '') {
            $book = Book::find($request->book_id);
        } else {
            $book = new Book();
        }
        $book->user_id = $loginUserId;
        $book->designed_for = $request->designed_for;
        $book->first_name = $request->first_name;
        $book->last_name = $request->last_name;
        $book->save();
        return $this->sendResponse($book, 'Data inserted successfully!');
    }
}
