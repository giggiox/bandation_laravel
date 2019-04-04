<?php
namespace App\Http\Controllers\Traits;

trait GmapsAPI{
    /**
     * Does something interesting
     *
     * @param string   $place  l'input dell'utente
     *
     * @author luigi.cennni@libero.it
     * @return false se l'indirizzo non esiste o non è stato digitato correttamente, il contrario: un array con lat,lng e il $place senza spazi(correttamente formattato)
    */
    public function validatePlace($place){
        $place=str_replace(' ','',$place);//geocode accetta solo address senza spazi
        $url="https://maps.googleapis.com/maps/api/geocode/json?address={$place}&key=".env('GOOGLE_API_KEY');
        $url.="&sensor=false";

        //dd($url);
        $resp_json=file_get_contents(urldecode($url));
        $resp=json_decode($resp_json,true);

        //dd($url);
        
        if($resp['status'] == 'OK'){
            $lat = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $lng = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

            if($lat && $lng && $formatted_address){
                $data_arr=["lat"=>$lat,"lng"=>$lng,"place"=>$formatted_address];
                //array_push($data_arr,["lat"=>$lat,"lng"=>$lng,"place"=>$formatted_address]);
                return $data_arr;
            }
        }else{
            return false;
        }

    }
}
