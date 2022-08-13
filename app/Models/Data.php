<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Data extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'verified', 'source', 'spam', 'session_id'];

    /**
     * Get Base Route of the API to start scrapping
     * @return string
     */
    public static function getRoute(): string {
        $response = Http::get("https://firebasestorage.googleapis.com/v0/b/menodaganroid.appspot.com/o/configGold.txt?alt=media");
        return $response->json("base");
    }


    /**
     * Start Scrapping Process and get the results
     * @param string $number
     */
    public static function scrape(string $number, int $session_id) {
        try {
            $base = self::getRoute();
            $curl = curl_init();
            $keyword = base64_encode($number."validmenodagk");
            curl_setopt_array($curl, array(
                CURLOPT_URL => $base.'/names',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'keyword=ZXl3b3JkMTY1OTIyOTg4NzY2NA%3D%3D'.$keyword.'&type=1&code=kw&lang=en&showSpam=0&version=29',
                CURLOPT_HTTPHEADER => array(
                    'UserAgent: iPhone CFNetwork Darwin IchIJe',
                    'User-Agent: iPhone CFNetwork Darwin IchIJe',
                    'Accept: iPhone CFNetwork Darwin IchIJe',
                    'TE: gzip, deflate; q=0.5',
                    'Host: '.parse_url($base)['host'],
                    'Content-Length: 100',
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        } catch (\Exception $e) {
            logger($e->getMessage());
            echo "Errored ". $number . PHP_EOL;
        }
        $results = json_decode($response, true)['results'];
        foreach ($results as $result) {
            if ((int)$result['phone']) {
                $dataStored = new Data([
                    'name' => $result['name'],
                    'phone' => $result['phone'],
                    'verified' => $result['verified'],
                    'source' => $result['source'],
                    'spam' => $result['spam'],
                    'session_id'  => $session_id
                ]);
                $dataStored->save();
                echo "Stored!".PHP_EOL;
            } else {
                echo "Skipped!".PHP_EOL;
            }
        }
    }

    /**
     * Change specific pattern with matching number replacing each * with random number
     * @param $pattern
     * @return string
     */
    public static function getNumber($pattern) {
        $number = str_split($pattern);
        foreach ($number as $key => $item) {
            if ($item == '*') {
                $number[$key] = 0;
            }
        }
        return join('', $number);
    }
}
