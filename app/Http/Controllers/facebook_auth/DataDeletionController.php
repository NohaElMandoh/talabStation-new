<?php

namespace App\Http\Controllers;

class DatDeletionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $signed_request = $_POST['signed_request'];
        $data = $this->parse_signed_request($signed_request);
        $user_id = $data['user_id'];

// Start data deletion

        $confirmation_code = "del_#{$user_id}"; // unique code for the deletion request
        $user_id = "del_#{$user_id}";

        $base_url = 'https://www.talabstation.org/deletion_status?id=';
        $con_url_one = $base_url . $user_id;
        $comma = ',';
        $confirm = 'confirmation_code:';
        $con_url_two = $con_url_one . $comma . $confirm . $confirmation_code;
// $status_url = '{$user_id}'; // URL to track the deletion
        $status_url = $con_url_two;

        $data = array(
            'url' => $status_url,
            'confirmation_code' => $confirmation_code,
        );
        echo json_encode($data);
    }

    function parse_signed_request($signed_request) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);
      
        $secret = "d73f0d17f1f0c99450c430b4bb93d86f"; // Use your app secret here
      
        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);
      
        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
          error_log('Bad Signed JSON signature!');
          return null;
        }
      
        return $data;
      }
      
      function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
      }
}
