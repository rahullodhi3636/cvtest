<?php
namespace App;
use Illuminate\Support\Facades\Auth;
// use App\User;
use substr;
use str_shuffle;

class Helper
{
    public static function sendSMS($to, $message) {

        $ch = curl_init("http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=hensco&passwd=95150428&mobilenumber=".rawurlencode($to)."&message=".rawurlencode($message)."&sid=VNDHEN");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function sendMobileSMS($mobilenumbers, $message){
        $user="CVSalon"; //your username
        //$password="35064158"; //your password
        $password="priyansh3341"; //your password
        $mobilenumbers="91".$mobilenumbers; //enter Mobile numbers comma seperated
        //$message = "test messgae"; //enter Your Message
        $senderid="SMSCountry"; //Your senderid
        $messagetype="N"; //Type Of Your Message
        $DReports="Y"; //Delivery Reports
        $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
        $message = urlencode($message);
        $ch = curl_init();
        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }
        $ret = curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt ($ch, CURLOPT_POSTFIELDS,"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
        // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
        $curlresponse = curl_exec($ch); // execute
        if(curl_errno($ch))
        echo 'curl error : '. curl_error($ch);
        if (empty($ret)) {
        // some kind of an error happened
        die(curl_error($ch));
        curl_close($ch); // close cURL handler
        }
        else {
        $info = curl_getinfo($ch);
        curl_close($ch); // close cURL handler
        return $curlresponse; //echo "Message Sent Succesfully" ;
        }
    }

    public static function generate_random_no($type,$no){
        if($type=='num'){
            $permitted_chars = '0123456789';
        }elseif($type=='digit'){
            $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }elseif($type=='both'){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $string = substr(str_shuffle($permitted_chars), 0, $no);
        return $string;
    }

}
