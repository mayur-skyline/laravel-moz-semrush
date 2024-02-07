<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SemrushController extends Controller
{
    public function index(Request $request)
    {
        $domain = $request->input('domain') ?? 'seobook.com';

        $apiKey = env('SEMRUSH_API_KEY'); // Replace with your actual SEMrush API key

        $apiUrl = config('constants.semrush.api_url') . "/?type=domain_organic&key={$apiKey}&display_filter=+|Ph|Co|Tr&display_limit=10&export_columns=Ph,Po,Pp,Pd,Nq,Cp,Ur,Tr,Tc,Co,Nr,Td&domain={$domain}&display_sort=tr_desc&database=us";

        $response = Http::withHeaders([])->get($apiUrl);

        $responseArray = [];
        if ($response->status() == 200) {
            // Split the response into rows
            $rows = explode("\n", $response->body()); // Use $response->body() to get the response content

            // Define an array to store column headers
            $headers = [];

            // Iterate through each row
            foreach ($rows as $row) {
                // Split each row into columns based on semicolon
                if (empty($row) || strpos($row, ';') === false) {
                    continue;
                } else {
                    $columns = explode(';', $row);
                }

                // If headers are not set, set them as the first row
                if (empty($headers)) {
                    $headers = $columns;
                } else {
                    // Combine headers with values into an associative array
                    $rowData = array_combine($headers, $columns);

                    // Append the row data to the main data array
                    $responseArray[] = $rowData;
                }
            }
        }
        return view('semrush/semrush_data', ['response' => $responseArray]);
    }
}
