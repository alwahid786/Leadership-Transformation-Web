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
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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
        // If Coming From Cover Page
        $book = Book::where('user_id', $loginUserId)->first('first_name');
        if ($book == null || empty($book)) {
            return redirect()->back()->withErrors('Please add proper data first.');
        }
        $book = Book::where('user_id', $loginUserId)->first();

        if ($user->page_number >= 7) {
            return view('pages.gratitude', compact('book'));
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 7]);
            return redirect('/gratitude');
        }
    }

    // Desire FUnction 
    public function desireFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);
        $book = Book::where('user_id', $loginUserId)->first();
        if ($book->gratitude == '' || $book->gratitude == null) {
            return redirect()->back()->with('nextError', 'Please insert and save Gratitude first.');
        }
        if ($user->page_number >= 8) {
            return view('pages.desire', compact('book'));
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 8]);
            return redirect('/desire');
        }
    }

    // WOW FUnction 
    public function wowFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);
        $book = Book::where('user_id', $loginUserId)->first();
        if ($book->desire == '' || $book->desire == null) {
            return redirect()->back()->with('nextError', 'Please insert and save Desire first.');
        }
        $book = Book::where('user_id', $loginUserId)->first();

        if ($user->page_number >= 9) {
            return view('pages.wow', compact('book'));
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 9]);
            return redirect('/wow');
        }
    }

    // vision FUnction 
    public function visionFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);
        $book = Book::where('user_id', $loginUserId)->first();
        if ($book->wow == '' || $book->wow == null) {
            return redirect()->back()->with('nextError', 'Please insert and save Wow first.');
        }
        $book = Book::where('user_id', $loginUserId)->first();

        if ($user->page_number >= 10) {
            return view('pages.vision', compact('book'));
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 10]);
            return redirect('/see-it');
        }
    }

    // inspiration FUnction 
    public function inspirationFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);
        $book = Book::where('user_id', $loginUserId)->first();
        if ($book->vision == '' || $book->vision == null) {
            return redirect()->back()->with('nextError', 'Please insert and save Vision first.');
        }
        $book = Book::where('user_id', $loginUserId)->first();

        if ($user->page_number >= 11) {
            return view('pages.inspiration', compact('book'));
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 11]);
            return redirect('/say-it');
        }
    }

    // execution FUnction 
    public function executionFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);
        $book = Book::where('user_id', $loginUserId)->first();
        if ($book->inspiration == '' || $book->inspiration == null) {
            return redirect()->back()->with('nextError', 'Please insert and save Inspiration first.');
        }
        $book = Book::where('user_id', $loginUserId)->first();

        if ($user->page_number >= 12) {
            return view('pages.execution', compact('book'));
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 12]);
            return redirect('/live-it');
        }
    }

    // conclusion FUnction 
    public function conclusionFunction(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $user = User::find($loginUserId);
        $book = Book::where('user_id', $loginUserId)->first();
        if ($book->execution == '' || $book->execution == null) {
            return redirect()->back()->with('nextError', 'Please insert and save Execution first.');
        }
        if ($user->page_number >= 13) {
            return view('pages.conclusion');
        } else {
            User::where('id', $loginUserId)->update(['page_number' => 13]);
            return redirect('/conclusion');
        }
    }

    // Show Cover Page
    public function coverPage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.cover', compact('book'));
    }

    // Show gratitude Page
    public function gratitudePage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.gratitude', compact('book'));
    }

    // Show wow Page
    public function wowPage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.wow', compact('book'));
    }

    // Show desire Page
    public function desirePage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.desire', compact('book'));
    }

    // Show Vision Page
    public function visionPage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.vision', compact('book'));
    }

    // Show inspiration Page
    public function inspirationPage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.inspiration', compact('book'));
    }

    // Show execution Page
    public function executionPage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.execution', compact('book'));
    }

    // Show conclusion Page
    public function conclusionPage(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.conclusion', compact('book'));
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
        $book->first_name = $request->first_name;
        $book->last_name = $request->last_name;
        $book->save();
        return $this->sendResponse($book, 'Data inserted successfully!');
    }

    // submit Gratitude Function 
    public function submitGratitude(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        $book->gratitude = $request->gratitude;
        $book->save();
        return redirect()->back()->with('gratitudeSuccess', 'Data inserted Successfully!');
    }

    // submit Desire Function 
    public function submitDesire(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        $book->desire = $request->desire;
        $book->save();
        return redirect()->back()->with('desireSuccess', 'Data inserted Successfully!');
    }

    // submit Wow Function 
    public function submitWow(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        $book->wow = $request->wow;
        $book->save();
        return redirect()->back()->with('wowSuccess', 'Data inserted Successfully!');
    }

    // submit Vision Function 
    public function submitVision(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        $book->vision = $request->vision;
        $book->save();
        return redirect()->back()->with('visionSuccess', 'Data inserted Successfully!');
    }

    // submit Inspiration Function 
    public function submitInspiration(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        $book->inspiration = $request->inspiration;
        $book->save();
        return redirect()->back()->with('inspirationSuccess', 'Data inserted Successfully!');
    }

    // submit Execution Function 
    public function submitExecution(Request $request)
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        $book->execution = $request->execution;
        $book->save();
        return redirect()->back()->with('executionSuccess', 'Data inserted Successfully!');
    }

    // Create A PDF Book Function 
    // public function createPdf()
    // {
    //     $loginUserId = Auth::user()->id;
    //     $book = Book::where('user_id', $loginUserId)->first();

    //     // Load PDFs
    //     $wowPdf = PDF::loadView('pages.wow-pdf', compact('book'));
    //     $gratitudePdf = PDF::loadView('pages.gratitude-pdf', compact('book'));
    //     $seePdf = PDF::loadView('pages.see-it-pdf', compact('book'));
    //     $sayPdf = PDF::loadView('pages.say-it-pdf', compact('book'));
    //     $livePdf = PDF::loadView('pages.live-it-pdf', compact('book'));

    //     // Set PDF sizes
    //     $pdfSize = [0, 0, 500, 800];
    //     $wowPdf->setPaper($pdfSize, 'portrait');
    //     $gratitudePdf->setPaper($pdfSize, 'portrait');
    //     $seePdf->setPaper($pdfSize, 'portrait');
    //     $sayPdf->setPaper($pdfSize, 'portrait');
    //     $livePdf->setPaper($pdfSize, 'portrait');

    //     // Save PDF Files
    //     $timestamp = time();
    //     $pdfDirectory = public_path('assets/pdf/');
    //     $wow = $timestamp . 'wow.pdf';
    //     $gratitude = $timestamp . 'gratitude.pdf';
    //     $see = $timestamp . 'see.pdf';
    //     $say = $timestamp . 'say.pdf';
    //     $live = $timestamp . 'live.pdf';

    //     $wowPdf->save($pdfDirectory . $wow);
    //     $gratitudePdf->save($pdfDirectory . $gratitude);
    //     $seePdf->save($pdfDirectory . $see);
    //     $sayPdf->save($pdfDirectory . $say);
    //     $livePdf->save($pdfDirectory . $live);

    //     // Define PDF paths
    //     $pdfsToMerge = [
    //         public_path('assets/pdf/pdf-1.pdf'),
    //         $pdfDirectory . $wow,
    //         public_path('assets/pdf/pdf-2.pdf'),
    //         $pdfDirectory . $gratitude,
    //         public_path('assets/pdf/pdf-3.pdf'),
    //         public_path('assets/pdf/pdf-4.pdf'),
    //         $pdfDirectory . $see,
    //         public_path('assets/pdf/pdf-5.pdf'),
    //         $pdfDirectory . $say,
    //         public_path('assets/pdf/pdf-6.pdf'),
    //         $pdfDirectory . $live,
    //         public_path('assets/pdf/pdf-7.pdf'),
    //     ];

    //     $finalPdf = 'Transformational Leadership ' . $timestamp . '.pdf';
    //     $mergedPdfPath = $pdfDirectory . $finalPdf;

    //     // Merge PDFs
    //     $pdf = PDFMerger::init();

    //     foreach ($pdfsToMerge as $pdfPath) {
    //         $pdf->addPDF($pdfPath, 'all');
    //     }
    //     $pdf->merge();
    //     $pdf->save($mergedPdfPath);

    //     // Set the response content-type to PDF
    //     $headers = [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename="Transformational Leadership.pdf"',
    //     ];

    //     // Return the merged PDF in a new tab
    //     return response()->file($mergedPdfPath, $headers);
    // }

    public function createPdf()
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        $pdf = PDF::loadView('pages.pdf', compact('book')); // load view and pass data
        $pdf->setPaper([0, 0, 800, 1200], 'portrait');
        // Set the response content-type to PDF
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=' . 'Transformational Leadership' . '".pdf"'
        ];

        // Return the rendered PDF in a new tab
        return response($pdf->stream(), 200, $headers);
    }

    // Working One 
    // public function createPdf()
    // {
    //     $loginUserId = Auth::user()->id;
    //     $book = Book::where('user_id', $loginUserId)->first();
    //     // Load the existing PDF
    //     $pdf = new Fpdi();
    //     $pageCount = $pdf->setSourceFile(public_path('assets/pdf/main-pdf.pdf'));

    //     // Iterate through pages and add dynamic content
    //     for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    //         $templateId = $pdf->importPage($pageNo);
    //         $pdf->addPage();
    //         $pdf->useTemplate($templateId);

    //         // Check if this is the specific page after which you want to add content
    //         if ($pageNo == 2) {
    //             $pdf->AddPage();
    //             $pdf->SetFont('Arial', 'B', 12);
    //             $pdf->SetXY(50, 50); // Set position for text
    //             $pdf->Cell(0, 10, $book->gratitude, 0, 0, 'L');
    //         }
    //     }

    //     // Output the modified PDF
    //     $outputPath = storage_path('app/public/' . time() . 'generated.pdf');
    //     $pdf->Output($outputPath, 'F');

    //     return response()->download($outputPath, 'generated.pdf');
    // }
    // public function createPdf()
    // {
    //     $loginUserId = Auth::user()->id;
    //     $book = Book::where('user_id', $loginUserId)->first();
    //     // dd($book->gratitude);
    //     // Initialize FPDI
    //     $pdf = new Fpdi();

    //     // Load the existing PDF
    //     $pageCount = $pdf->setSourceFile(public_path('assets/pdf/main-pdf.pdf'));

    //     // Initialize TCPDF for rendering HTML
    //     $tcpdf = new TCPDF();

    //     // Iterate through pages and add dynamic content
    //     for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    //         $templateId = $pdf->importPage($pageNo);
    //         $pdf->AddPage();
    //         $pdf->useTemplate($templateId);

    //         // Check if this is the specific page after which you want to add content
    //         if ($pageNo == 2) {
    //             // $pdf->AddPage();

    //             // // Set the position for HTML content
    //             // $htmlContent = $book->gratitude;
    //             // // $htmlContent = View::make('pages.pdf', ['book' => $book])->render();
    //             // $tcpdf->AddPage();
    //             // $tcpdf->writeHTML($htmlContent);

    //             $pdf->AddPage();
    //             $pdf->SetFont('Arial', 'B', 12);
    //             $pdf->SetXY(50, 50); // Set position for text
    //             $pdf->Cell(0, 10, View::make('pages.pdf', ['book' => $book])->render(), 0, 0, 'L');
    //         }
    //     }

    //     // Output the modified PDF
    //     $outputPath = storage_path('app/public/' . time() . 'generated.pdf');
    //     $pdf->Output($outputPath, 'F');

    //     return response()->download($outputPath, 'generated.pdf');
    // }

    public function viewPdf()
    {
        $loginUserId = Auth::user()->id;
        $book = Book::where('user_id', $loginUserId)->first();
        return view('pages.pdf', compact('book'));
    }
}
