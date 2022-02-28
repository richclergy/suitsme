<?php

namespace App\Http\Controllers\Cashback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // validate user input;
        $data = $request->file('txn');
        dd($data);
        $transactions = json_decode($data);
    }

    public function convertCsv()
    {

    }
}
