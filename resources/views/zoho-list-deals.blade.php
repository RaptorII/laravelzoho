<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <link href="{{ asset('css/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

</head>
<body class="antialiased">

<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary" href="/zoho-add-deal-view">zoho-add-deal-view</a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-primary" href="/zoho-list-deals">zoho-list-deals</a>
        </div>
    </div>
    <br>
    <div class="row">

        <table class="table">
            <thead>
            <tr>
                <th>Deal_Name</th>
                <th>Amount</th>
                <th>Account_Name</th>
                <th>Stage</th>
                <th>Closing_Date</th>
                <th>Contact_Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($deals['data'] as $deal)
                <tr>
                    <td>{{ $deal['Deal_Name'] }}</td>
                    <td>{{ $deal['Amount'] }}</td>
                    <td>{{ $deal['Account_Name']['name'] }}</td>
                    <td>{{ $deal['Stage'] }} </td>
                    <td>{{ $deal['Closing_Date'] }}</td>
                    <td>{{ $deal['Contact_Name']['name'] }}</td>
                    <td>{{ $deal['Description'] }}</td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
</div>

<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

    <?php
    dump($deals);
    ?>

</div>
</body>
</html>
