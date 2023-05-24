<?php

    // use App\Model\WebModel\Originator\Auth\session as originator_session;
    // use App\Model\WebModel\Brand\Auth\session as brand_session;

use App\Models\Setting;
use App\Models\User;
use App\Models\CaseConcern;
use Illuminate\Support\Facades\Storage;

    function randomAlphaNumericCode_h($length=8,$prefix=''){
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return $prefix.substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    function randomNumericCode_h($length=8,$prefix=''){
        $pool = '0123456789';
        return $prefix.substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    function randomStringCode_h($length=8,$prefix=''){
        $pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return $prefix.substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    function isEmail_h($emailaddress){
        return filter_var($emailaddress,FILTER_VALIDATE_EMAIL);
    }

    function isValidIP_h($IP){
        return filter_var($IP, FILTER_VALIDATE_IP);
    }

    function objToArray_h($obj){
        if(isObjArray_h($obj)){
            return $obj_array = json_decode(json_encode($obj),true);
        }
        return [];
    }


    function isObjArray_h($data=NULL){
        if(is_array($data)){
            $data = array_filter($data);
        }

        if((is_array($data) || is_object($data) ) && !empty($data) && /*count($data)>0 &&*/ collect($data)->count() > 0) {
            return true;
        } else {
            return false;
        }
    }


    function arrayToObj_h($ArrayData){
        return json_decode(json_encode($ArrayData));

    }

    function jsonTOArray_h($JsonData){
        return json_decode($JsonData,TRUE);
    }

    function removeKeyValueFromArray_h($array_DATA,$keyname){
        $return_array = [];
        foreach($array_DATA as $arrayDATAK=>$arrayDATA){
            unset($arrayDATA[$keyname]);
            $arrayDATA[$keyname] = $arrayDATA;

        }
    }

    function getOrNullInput_h($Input,$key,$default=null){
        return isset($Input[$key])?$Input[$key]:$default;
    }

    /*function getIp_h(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  {
            //to check ip is pass from proxy
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else{
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }*/

    function decimalOnly_h($string){
        if(is_numeric($string)){
            return $string;
        }
        preg_match('/([0-9]+\.[0-9]+)/', $string, $matches);
        if(isset($matches[0])){
            return $matches[0];
        } else {
            return '';
        }

    }

    function hr12To24_h($string){
        return date("H:i", strtotime($string));
    }

    // function getGEOInfo_h($AddresscityORZIP){
    //     return json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($AddresscityORZIP)),true);
    //     //
    // }

    function datetimeFromUnix_h($thetime='now',$timezone,$date_format='F j Y h:i:s A'){
        if(is_numeric($thetime)){
            $dt = new \DateTime('@'.$thetime);
            $dt->setTimeZone(new \DateTimeZone($timezone));
            return $dt->format($date_format);
        } else {
            $date = new \DateTime($thetime, new \DateTimeZone($timezone));
            return $date->format($date_format);
        }
    }

    function getGMT_from_timezone_h($timezone_name){


        $dtz = new DateTimeZone($timezone_name);
        $time_in_sofia = new DateTime('now', $dtz);
        //    echo $dtz->getOffset( $time_in_sofia );
        //    to display it in the format GMT+x:


        $offset = $dtz->getOffset( $time_in_sofia ) / 3600;

        return ($offset < 0 ? $offset : $offset);

        dd("GMT" . ($offset < 0 ? $offset : "+".$offset));

        dd($dtz->getOffset( $time_in_sofia ) / 3600);

        return $dtz->getOffset( $time_in_sofia ) / 3600;


        echo "GMT" . ($offset < 0 ? $offset : "+".$offset);

    }

    function getOrNullInput($array, $columnName){
        return isset($array[$columnName]) ? $array[$columnName] : null;
    }

    //getTimestamp
    function getGEODATA_h($ip=''){
        if($ip ==''){
            $ip = Request()->ip();
        }

        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

        $returnParams = [
            'city'=>getOrNullInput($query,'city'),
            'lat'=>getOrNullInput($query,'lat'),
            'countryCode'=>getOrNullInput($query,'countryCode'),
            'country'=>getOrNullInput($query,'country'),
            //'regionName'=>getOrNullInput($query,'regionName'),
            'region'=>getOrNullInput($query,'region'), //state
            'lon'=>getOrNullInput($query,'lon'),
            'timezone'=>getOrNullInput($query,'timezone'),
            'zip'=>getOrNullInput($query,'zip'),
            'suburb'=>getOrNullInput($query,'suburb'),
        ];
        return $returnParams;
    }

    function zeroNullToOne_h($val){
        return $val == 0 || $val == null?1:$val;
    }

    function nullToZero_h($val=null){
        return $val == '' && !is_numeric($val) && !is_null($val) ? 0 : $val;
    }



    function getIP_h()
    {
        return Request()->ip();

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($iplist as $ip) {
                    $ip_address = $ip;
                }
            } else {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }


        return $ip_address;

    }

    function encrypt_h($q)
    {
        $cryptKey = env('APP_KEY');

        $qEncoded = md5($q);
        //$qEncoded = openssl_encrypt($q, 'AES-128-CBC', md5($cryptKey), OPENSSL_RAW_DATA, md5(md5($cryptKey)));
        //dd($qEncoded);
        //$qEncoded = base64_encode(openssl_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return ($qEncoded);
    }

    function decrypt_h($q)
    {
        $cryptKey = env('APP_KEY');
        $qDecoded = rtrim(openssl_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return ($qDecoded);
    }

    function checkValueFromArrayByColumns_h($array,$value,$column){
        if(/*COUNT($array) > 0 */collect($array)->count() > 0){
            return collect(array_keys(array_column($array, $column), $value))->count() > 0 ? true : false;
            //return COUNT(array_keys(array_column($array, $column), $value)) > 0 ? true : false;
        }
        return false;
    }

    function strToUsername_h($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return strtolower(preg_replace('/-+/', '-', $string)); // Replaces multiple hyphens with single one.
    }


    /* ============== Domains ============== */

    // function domain_h(){
    //     return trans('siteConfig.domain');
    // }

    /* ============== Web Domains ============== */

    // function web_retail_domain_h(){
    //     return trans('siteConfig.subDomain.web.retail').'.'.domain_h();
    // }

    // function web_wholesale_domain_h(){
    //     return trans('siteConfig.subDomain.web.wholesale').'.'.domain_h();
    // }

    // function web_originator_domain_h(){
    //     return trans('siteConfig.subDomain.web.originator').'.'.domain_h();
    // }

    // function web_brand_domain_h(){
    //     return trans('siteConfig.subDomain.web.brand').'.'.domain_h();
    // }

    /* ============== Web Domains End ============== */

    /* ============== API Domains ============== */

    // function api_retail_domain_h(){
    //     return trans('siteConfig.subDomain.api.retail').'.'.domain_h();
    // }

    // function api_wholesale_domain_h(){
    //     return trans('siteConfig.subDomain.api.wholesale').'.'.domain_h();
    // }

    // function api_originator_domain_h(){
    //     return trans('siteConfig.subDomain.api.originator').'.'.domain_h();
    // }

    // function api_brand_domain_h(){
    //     return trans('siteConfig.subDomain.api.brand').'.'.domain_h();
    // }

    /* ============== API Domains End ============== */

    /* ============== Domains End ============== */

    /* ============== API Response ============== */

    function apiResponseParameters_h($success,$message,$data=[]){
        return ['success'=>$success,'message'=>$message,'data'=>$data];
    }

    function successArrayResponse_h($message='',$data=[]){
        return apiResponseParameters_h(true,$message,$data);
    }

    function errorArrayResponse_h($message='',$data=[]){
        return apiResponseParameters_h(false,$message,$data);
    }

    function jsonErrorCodes_h($statusCode=''){
        $statusCodes =  [
            'success' => 200,
            'successCreated' => 201,
            'successAsync' => 202,
            'error' => 400,
            'errorUnauthorized' => 401,
        ];

        return ($statusCode != '' && !is_null($statusCode)) ? $statusCodes[$statusCode] : $statusCodes;
    }


    function successJsonResponse_h($message='',$data=[]){
        return response()->json(apiResponseParameters_h(true,$message,$data),jsonErrorCodes_h('success'));
    }

    function successCreatedJsonResponse_h($message='',$data=[]){
        return response()->json(apiResponseParameters_h(true,$message,$data),jsonErrorCodes_h('successCreated'));
    }

    function successAsyncJsonResponse_h($message='',$data=[]){
        return response()->json(apiResponseParameters_h(true,$message,$data),jsonErrorCodes_h('successCreated'));
    }


    function errorJsonResponse_h($message='',$data=[], $status=null){
        $status = empty($status) ? jsonErrorCodes_h('error') : $status;
        return response()->json(apiResponseParameters_h(false,$message,$data),$status);
        // return response()->json(["Success" => true,"message" => $message],200);
    }

    function errorUnauthorizedJsonResponse_h($message='',$data=[]){
        return response()->json(apiResponseParameters_h(false,$message,$data),jsonErrorCodes_h('errorUnauthorized'));
    }

    /* ============== API Response End ============== */

    function storageUrl_h($image=''){
        // dd(Storage::disk(env('FILE_SYSTEM'))->url($image));
        if(!is_null($image) && $image!= '' && Storage::disk(env('FILE_SYSTEM'))->exists($image)){
            //return asset('storage/'.$image);
            //return Storage::disk(env('FILE_SYSTEM'))->path($image);
            return Storage::disk(env('FILE_SYSTEM'))->url($image);
        }else{
            return Storage::disk(env('FILE_SYSTEM'))->url(trans('MediaPath.no-image'));
        }
    }

    function storageFileUrl_h($image=''){
        if(!is_null($image) && $image!= '' && Storage::disk(env('FILE_SYSTEM'))->exists($image)){
            return asset('storage/'.trans('MediaPath.file'));
            return Storage::disk(env('FILE_SYSTEM'))->url(trans('MediaPath.file'));
        }else{
            return Storage::disk(env('FILE_SYSTEM'))->url(trans('MediaPath.no-file'));
        }
    }

    function media_h($media_info=[]){
        $media_info = collect($media_info)->toArray();
        $image = '';
        if (collect($media_info)->isNotEmpty()){
            if(strtoupper($media_info['type']) == 'IMAGE'){

                if(strtoupper($media_info['value_type']) == 'UPLOADED'){
                    $image = $media_info['path'].$media_info['value'];
                }elseif(strtoupper($media_info['value_type']) == 'URL'){
                    $image = $media_info['value'];
                }
            }
        }

        return $image;
    }

    // function originatorSession_h($name=''){

    //     $sessionNames = originator_session::sessionNames($name);
    //     if($name != '' && !is_null($name)){
    //         return session($sessionNames);
    //     }

    //     $session = [];
    //     foreach($sessionNames as $sessionKey => $sessionName){
    //         $session[$sessionKey] = session($sessionName);
    //     }

    //     return $session;
    // }

    // function originatorSessionUpdate_h($nameWithValues){

    //     if(empty($nameWithValues))
    //         return false;
        
    //     $session = Request()->session();
    //     $sessionOrigName = originator_session::sessionNames();
        
    //     foreach($nameWithValues as $sessionName => $sessionValue){
    //         $session->put($sessionOrigName[$sessionName], $sessionValue);
    //     }

    //     return true;
    // }

    // function brandSession_h($name=''){

    //     $sessionNames = brand_session::sessionNames($name);
    //     if($name != '' && !is_null($name)){
    //         return session($sessionNames);
    //     }

    //     $session = [];
    //     foreach($sessionNames as $sessionKey => $sessionName){
    //         $session[$sessionKey] = session($sessionName);
    //     }

    //     return $session;
    // }

    // function brandSessionUpdate_h($nameWithValues){

    //     if(empty($nameWithValues))
    //         return false;
        
    //     $session = Request()->session();
    //     $sessionOrigName = brand_session::sessionNames();
        
    //     foreach($nameWithValues as $sessionName => $sessionValue){
    //         $session->put($sessionOrigName[$sessionName], $sessionValue);
    //     }

    //     return true;
    // }

    // function session_h($name=''){
        
    //     $domain = Request()->getHost();
    //     $sessions = '';
    //     if($domain == web_originator_domain_h()){
    //         $sessions = originatorSession_h($name);
    //     }elseif($domain == web_brand_domain_h()){
    //         $sessions = brandSession_h($name);
    //     }

    //     return $sessions;
    // }

    // function sessionUpdate_h($nameWithValues){

    //     $domain = Request()->getHost();
    //     $res = '';
    //     if($domain == web_originator_domain_h()){
    //         $res = originatorSessionUpdate_h($nameWithValues);
    //     }elseif($domain == web_brand_domain_h()){
    //         $res = brandSessionUpdate_h($nameWithValues);
    //     }

    //     return $res;
    // }

    /* ============== Nav ============== */

    /* ============== Originator Nav ============== */

    // function checkNavPermission($FormIDs){

    //     $domain = Request()->getHost();

    //     if($domain == web_originator_domain_h()){
    //         $permissionGet = new \App\Model\WebModel\Originator\PermissionModel\permission();
    //     }elseif($domain == web_brand_domain_h()){
    //         $permissionGet = new \App\Model\WebModel\Brand\PermissionModel\permission();
    //     }else{
    //         return false;
    //     }

    //     foreach($FormIDs as $FormID){
    //         $permission = $permissionGet::PermissionFor($FormID);
    //         if($permission['success'])
    //             return true;
    //     }

    //     return false;
    // }

    /* ============== Originator Nav End ============== */

    /* ============== Originator Nav ============== */

    // function checkBrandNavPermission($FormIDs){
    //     foreach($FormIDs as $FormID){
    //         $permission = \App\Model\WebModel\Brand\PermissionModel\permission::PermissionFor($FormID);
    //         if($permission['success'])
    //             return true;
    //     }

    //     return false;
    // }

    /* ============== Originator Nav End ============== */

    // function checkActiveNav($FormIDs){

    //     if(isset(Request()->this_form_permission)){
    //         $ThisFormPermission = collect(Request()->this_form_permission);
    //         if(in_array($ThisFormPermission['form_id'], $FormIDs))
    //             return true;
    //         /*foreach($FormIDs as $FormID){
    //             if($ThisFormPermission['form_id'] == $FormID)
    //                 return true;
    //         }*/
    //     }
    //     return false;
    // }

    /* ============== Nav End ============== */

    /* ============== Dynamic Fields ============== */

    function dynamicField(){



    }

    /* ============== Dynamic Fields End ============== */


    function get_combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    function get_user_browser_h($user_agent=null) {

        $user_agent = empty($user_agent) ? Request()->header('User-Agent') : $user_agent;

        $browser_full_name = 'Unknown Browser';
        $browser_name = 'Unknown';
        $platform = 'Unknown';

        //First get the platform?
        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
        {
            $browser_full_name = 'Internet Explorer < 11';
            $browser_name = "MSIE";
        }
        elseif(preg_match('/rv:/i',$user_agent) && preg_match('/Trident/i',$user_agent))
        {
            $browser_full_name = 'Internet Explorer 11';
            $browser_name = "MSIE";
        }
        elseif(preg_match('/Edge/i',$user_agent))
        {
            $browser_full_name = 'Microsoft Edge';
            $browser_name = "Edge";
        }
        elseif(preg_match('/Firefox/i',$user_agent))
        {
            $browser_full_name = 'Mozilla Firefox';
            $browser_name = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$user_agent))
        {
            $browser_full_name = 'Google Chrome';
            $browser_name = "Chrome";
        }
        elseif(preg_match('/Safari/i',$user_agent))
        {
            $browser_full_name = 'Apple Safari';
            $browser_name = "Safari";
        }
        elseif(preg_match('/Opera/i',$user_agent))
        {
            $browser_full_name = 'Opera';
            $browser_name = "Opera";
        }
        elseif(preg_match('/Netscape/i',$user_agent))
        {
            $browser_full_name = 'Netscape';
            $browser_name = "Netscape";
        }

        return [
            'browser_full_name' => $browser_full_name,
            'browser_name' => $browser_name,
            'platform' => $platform
        ];
    }

    function getCurrency($amount){
        return trans('siteConfig.default_currency').' '.number_format($amount,2);
    }

    // function getDeviceSource(){
    //     $agent = new \Jenssegers\Agent\Agent;
    //     //dd($agent->getUserAgent(), $agent->isAndroidOS(), $agent->isiOS(), $agent->browser(), $agent->device(), $agent->platform());
    //     //dd($agent->getUserAgent(), $agent->isAndroidOS(), $agent->isiOS(), $agent->browser(), $agent->device(), $agent->platform());
    //     $data = [];
    //     if($agent->isDesktop()){
    //         $data['source_id'] = trans('siteConfig.source.WEB_DESKTOP');
    //         $data['source_name'] = 'WEB_DESKTOP';
    //     }elseif($agent->isTablet()){
    //         $data['source_id'] = trans('siteConfig.source.WEB_DESKTOP');
    //         $data['source_name'] = 'WEB_DESKTOP';
    //     }
    // }

    function setting_h(){
        return Setting::first();
    }

    function caseConcers_h($id){
        $user = User::find($id);
        $last_post = $user->concerns()->latest()->first();
        return $last_post;
        // return User::where('id',$id)->select(['id'])->with('concerns')->last();
    }

    function latest_caseConcers_h(){
        $caseConcerns = CaseConcern::latest()->first();
        return $caseConcerns;
        // return User::where('id',$id)->select(['id'])->with('concerns')->last();
    }

?>
