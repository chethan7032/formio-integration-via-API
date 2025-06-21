<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});






Route::get('/formio', function () {
    $response = Http::get('https://aomugydeiyvrfvc.form.io/contactform');

    // Check for errors
    if ($response->successful()) {
        $formSchema = $response->json();
        return view('formio', ['schema' => $formSchema]);
    } else {
        return 'Failed to fetch form schema';
    }
});





// Show the custom form (GET)
Route::get('/contact', function () {
    return view('contact');
});

// Handle the form submission (POST)
Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $data = [
        'data' => [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]
    ];

    $response = Http::post('https://aomugydeiyvrfvc.form.io/contactform/submission', $data);

    if ($response->successful()) {
        return back()->with('success', 'Form submitted successfully!');
    } else {
        return back()->with('error', 'Form submission failed.');
    }
});






// Route::get('/submissions', function () {
//     $url = env('FORMIO_API_SUBMISSION_URL');

//     $response = Http::get($url);

//     if ($response->successful()) {
//         $submissions = $response->json()['data'];
//         return view('submissions', compact('submissions'));
//     } else {
//         return "Failed to fetch submissions.";
//     }
// });







// Route::get('/submissions', function () {
//     $url = env('FORMIO_API_SUBMISSION_URL');

//     $response = Http::get($url);

//     if ($response->successful()) {
//         $submissions = $response->json(); // Directly use the root array
//         return view('submissions', compact('submissions'));
//     } else {
//         Log::error('Form.io API error:', [
//             'status' => $response->status(),
//             'body' => $response->body()
//         ]);

//         return "Failed to fetch submissions.<br>Status: " . $response->status() . "<br>Body: " . $response->body();
//     }
// });







Route::get('/submissions', function () {
    $url = env('FORMIO_API_SUBMISSION_URL');
    $response = Http::get($url);

    if (!$response->successful()) {
        Log::error('Form.io API error:', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        return "Failed to fetch submissions.<br>Status: " . $response->status() . "<br>Body: " . $response->body();
    }

    $submissions = collect($response->json());

    // Filter by email
    if ($email = request('email')) {
        $submissions = $submissions->filter(function ($submission) use ($email) {
            return Str::contains(strtolower($submission['data']['email'] ?? ''), strtolower($email));
        });
    }

    // Filter by date
    if ($date = request('date')) {
        $submissions = $submissions->filter(function ($submission) use ($date) {
            return \Illuminate\Support\Str::contains($submission['created'], $date);
        });
    }

    // Pagination (manual)
    $perPage = 6;
    $page = request('page', 1);
    $submissions = $submissions->slice(($page - 1) * $perPage, $perPage)->values();

    return view('submissions', compact('submissions'));
});
