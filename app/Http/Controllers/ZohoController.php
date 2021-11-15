<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

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

    public function zohoListDeals()
    {
        $access_token = $this->getAccessToken();

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

        $response = json_decode( curl_exec( $ch ) );
        echo '<pre>';
        print_r($response);
    }

    public function zohoAddDeal()
    {
        $access_token = $this->getAccessToken();

        //	Amount	Stage	Closing_Date	Account_Name	Contact_Name

        $post_data=[
            'data' => [
                [
                    'Deal_Name'     => 'Test Deal 1',
                    'Amount'        => '432000',
                    'Account_Name'  => 'Name of deals 1',
                    'Stage'         => 'Current stage2',
                    'Closing_Date'  => '2021-11-19',
                    'Contact_Name'  => '5090311000000366191',
                    'Description'   => 'Description 1 ',
                ],
                [
                    'Deal_Name'     => 'Test Deal 2',
                    'Amount'        => '333000',
                    'Account_Name'  => 'Name of deals 2',
                    'Stage'         => 'Current stage1',
                    'Closing_Date'  => '2021-11-21',
                    'Contact_Name'  => '5090311000000366190',
                    'Description'   => 'Description 2',
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

        $response = json_decode( curl_exec( $ch ) );
        echo '<pre>';
        print_r($response);

    }

}
