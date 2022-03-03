<?php

namespace App\Http\Controllers\Cashback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // validate user input;
        $path = $request->file('txn');
        $jsonString = file_get_contents($path);
        $data = json_decode($jsonString, true);
        return $this->convertCsv($data);
    }

    public function convertCsv($data)
    {
        $fileName = Str::random(8).date('Y-m-d').'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'Id', 'merchant', 'customerRef', 'clearedTxnAmount',
            'txnCurrency', 'txnDateTime',
        );

        $callback = function () use ($data, $columns) {
            $internal = ["Suitsme Internal"];
            $external = ["Suitsme External"];

            $file = fopen('php://output', 'w');
            fputcsv($file, $internal);
            fputcsv($file, $columns);

            foreach ($data as $row) {
                if (empty($data)) {
                    return;
                }
                if ($row['payee']['merchantId'] == 1144 || $row['payee']['merchantId'] == 2033) {
                    $rows['Id'] = "'".$row['id']."'";
                    $rows['merchant'] = "".$row['payee']['merchantId']."";
                    $rows['customerRef'] = "".$row['payer']['accountNo']."";
                    $rows['customerRef'] = "".$row['amount']."";
                    $rows['txnCurrency'] = $row['currency'];
                    $rows['txnDateTime'] = "".$row['created_date_time']."";

                    fputcsv(
                        $file, 
                        array(
                            $rows['Id'], $rows['merchant'], $rows['customerRef'], 
                            $rows['customerRef'], $rows['txnCurrency'], 
                            $rows['txnDateTime']
                        )
                    );
                }
                
            }

            $columns1 = array(
                'id', 'merchantId', 'accountNumber', 'transactionAmount',
                'currency', 'dateTime',
            );

            fputcsv($file, $external);
            fputcsv($file, $columns1);
    
            foreach ($data as $row) {
                if (empty($data)) {
                    return;
                }
                
                if ($row['payee']['merchantId'] == 1022 || $row['payee']['merchantId'] == 7596) {
                    $rows['id'] = "'".$row['id']."'";
                    $rows['merchantId'] = "".$row['payee']['merchantId']."";
                    $rows['accountNumber'] = "'".$row['payer']['accountNo']."'";
                    $rows['transactionAmount'] = "".$row['amount']."";
                    $rows['currency'] = $row['currency'];
                    $rows['dateTime'] = "".$row['created_date_time']."";
    
                    fputcsv(
                        $file, 
                        array(
                            $rows['id'], $rows['merchantId'], $rows['accountNumber'], 
                            $rows['transactionAmount'], $rows['currency'], 
                            $rows['dateTime']
                        )
                    );
                }
                
            }
    
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    
}
