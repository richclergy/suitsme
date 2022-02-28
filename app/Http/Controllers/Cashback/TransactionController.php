<?php

namespace App\Http\Controllers\Cashback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // validate user input;
        $path = $request->file('txn');
        $jsonString = file_get_contents($path);
        $data = json_decode($jsonString, true);
        print_r($data);

        /* $jsonString = file_get_contents(base_path('public/json/N4Eje3JbsOXUhjypIXnvkH9tY7q1Rg7qfd4b0Beh.json'));
        $data = json_decode($jsonString, true);
        print_r($data); */
    }

    public function convertCsv()
    {

    }
}
