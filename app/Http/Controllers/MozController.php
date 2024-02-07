<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class MozController extends Controller
{
    public function index()
    {
        $accessId = env('MOZ_ACCESS_ID');
        $secretKey = env('MOZ_SECRET_KEY');

        $limit = 5;
        $offset = 0;

        $mozTopUrl = Config::get('constants.moz.top_url');

        $authHeader = 'Basic ' . base64_encode("$accessId:$secretKey");

        $response = Http::withHeaders(['Authorization' => $authHeader])
            ->post($mozTopUrl, ['limit' => $limit, 'offset' => $offset]);

        $responseArray = [];
        if ($response->successful()) {
            $responseData = json_decode($response, true);

            foreach ($responseData['results'] as $get_top_data) {
                // Access specific properties within each result
                $rootDomain = $get_top_data['root_domain'];

                $expires = Carbon::now()->addMinutes(5)->timestamp;

                $domain_Encoded = urlencode($rootDomain);

                $stringToSign = "{$accessId}\n{$expires}";
                $signature = base64_encode(hash_hmac('sha1', $stringToSign, $secretKey, true));

                $mozApiUrl = config('constants.moz.rank_url') . "/{$domain_Encoded}?Cols=103146375200&AccessID={$accessId}&Expires={$expires}&Signature={$signature}";

                $mozRankResponse = Http::withHeaders(['Authorization' => $authHeader])->get($mozApiUrl);

                if ($mozRankResponse->status() == 200) {
                    $mozRankResponseData = json_decode($mozRankResponse->body(), true);
                    $moz_rank = "";
                    if ($mozRankResponseData['umrp'] != '') {
                        $moz_rank = $mozRankResponseData['umrp'];
                    }
                    // For example, you might want to store them in an array or perform other operations
                    $responseArray[] = [
                        'moz_rank' => $moz_rank,
                        'root_domain' => $get_top_data['root_domain'],
                        'root_domains_to_root_domain' => $get_top_data['root_domains_to_root_domain'],
                        'domain_authority' => $get_top_data['domain_authority'],
                        'link_propensity' => $get_top_data['link_propensity'],
                        'spam_score' => $get_top_data['spam_score'],
                    ];
                }
            }
        }
        return view('moz/moz_global_top_domains', ['response' => $responseArray]);
    }
}
