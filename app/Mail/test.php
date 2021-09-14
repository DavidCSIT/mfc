<?php
    namespace App\Mail;
    use App\Mail\TestEmail;

    $data = ['message' => 'This is a test!'];

    Mail::to('cartman.david@gmail.com')->send(new TestEmail($data));