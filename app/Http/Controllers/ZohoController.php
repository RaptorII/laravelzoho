<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZohoController extends Controller
{
    private function getAccessToken()
    {

        $post = [
            'refresh_token'  => '1000.5cca9d23c5bd40ae7b88a9aa429618a9.1d7e09e18bebfb2070406b8b4930b802',
            'client_id'      => '1000.LQS8XE74OZ0FHN76JESROEXIQY17GA',
            'client_secret'  => 'f65db165499d8703e988403bd958504e423b9ad89f',
            'grant_type'     => 'refresh_token',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.zoho.com/oauth/v2/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded'] );

        $response = json_decode( curl_exec( $ch ) );
        return $response->access_token;

    }

    public function zohoListСontacts()
    {
        $access_token = $this->getAccessToken();

//        echo 'acces token=';
//        print_r($access_token);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.zohoapis.com/crm/v2/Contacts');
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                'Authorization: Zoho-oauthtoken ' . $access_token,
                "Content-Type: application/x-www-form-urlencoded",
            ]
        );

        $response = json_decode( curl_exec( $ch ), TRUE );

        return $response['data'];
    }

    public function zohoListDeals()
    {
        $access_token = $this->getAccessToken();

        echo 'acces token=';
        print_r($access_token);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.zohoapis.com/crm/v2/Deals');
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                'Authorization: Zoho-oauthtoken ' . $access_token,
                "Content-Type: application/x-www-form-urlencoded",
            ]
        );

        $response = json_decode( curl_exec( $ch ), TRUE );

        return view('zoho-list-deals', ['deals' => $response]);

    }

    public function zohoAddDealView()
    {
        $access_token = $this->getAccessToken();
        $contacts = $this->zohoListСontacts();

        return view('zoho-add-deal', [
//            'message' => 'all is fine!',
            'contacts' => $contacts,
        ]);
    }

    public function zohoAddDeal(Request $request)
    {
        $access_token = $this->getAccessToken();

        $post_data=[
            'data' => [
                [
                    'Deal_Name'     => $request->input('Deal_Name'),
                    'Amount'        => $request->input('Amount'),
                    'Account_Name'  => $request->input('Account_Name'),
                    'Stage'         => $request->input('Stage'),
                    'Closing_Date'  => $request->input('Closing_Date'),
                    'Contact_Name'  => $request->input('Contact_Name'),
                    'Description'   => $request->input('Description'),
                ],
            ],
            'triger' => [
                'approval',
                'workflow',
                'blueprint',
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.zohoapis.com/crm/v2/Deals');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $post_data ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                'Authorization: Zoho-oauthtoken ' . $access_token,
                "Content-Type: application/x-www-form-urlencoded"
            ]
        );

        curl_exec( $ch );

        return redirect()->route('zohoListDeals');
    }

}
