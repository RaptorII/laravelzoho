<?php
?>


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

{{--    {{ $message ?? '' }}--}}
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
        <?php

        echo Form::open(['url' => 'zoho-add-deal', 'method' => 'Post', 'class' => 'col-md-12']);

        echo '<div class="form-group row">';
        echo Form::label('Deal_Name', 'Deal_Name', ['class' => 'col-md-2']) . Form::text('Deal_Name', null, ['class' => 'col-md-6']);
        echo '</div>';
        echo '<div class="form-group row">';
        echo Form::label('Amount', 'Amount', ['class' => 'col-md-2']) . Form::text('Amount', null, ['class' => 'col-md-6']);
        echo '</div>';
        echo '<div class="form-group row">';
        echo Form::label('Account_Name', 'Account_Name', ['class' => 'col-md-2']) . Form::text('Account_Name', null, ['class' => 'col-md-6']);
        echo '</div>';
        echo '<div class="form-group row">';
        echo Form::label('Stage', 'Stage', ['class' => 'col-md-2']) . Form::text('Stage', null, ['class' => 'col-md-6']);
        echo '</div>';
        echo '<div class="form-group row">';
        echo Form::label('Closing_Date', 'Closing_Date', ['class' => 'col-md-2']) . Form::text('Closing_Date', null, ['class' => 'col-md-6']);
        echo '</div>';
        echo '<div class="form-group row">';
        echo Form::label('Contact_Name', 'Contact_Name', ['class' => 'col-md-2']);

        ?>
        <select name="Contact_Name" class="col-md-6">
            @foreach ($contacts as $contact)
                <option label="<?=$contact['Full_Name']?>"
                        value="<?=$contact['id']?>"><?=$contact['Full_Name']?></option>
            @endforeach
        </select>
        <?php
        echo '</div>';
        echo '<div class="form-group row">';
        echo Form::label('Description', 'Description', ['class' => 'col-md-2']) . Form::text('Description', null, ['class' => 'col-md-6']);
        echo '</div>';
        echo '<div class="form-group row">';
        echo Form::submit('Add!', ['class' => 'btn btn-primary']);
        echo '</div>';
        echo Form::close();

        ?>
    </div>
</div>

<div>
errors from api:
    <?php
    dump($message ?? '');
    dump($details ?? '');
    // dump($contacts?? '');
    ?>

</div>
</body>
</html>
