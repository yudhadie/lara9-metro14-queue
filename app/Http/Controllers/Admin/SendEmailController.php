<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('admin.email.index',[
            'title' => 'Email',
            'subtitle' => 'Kirim email menggunakan laravel',
            'breadcrumbs' => Breadcrumbs::render('email'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        dispatch(new SendMailJob($data));
        return redirect()->route('email.index')->with(['success' => 'Pesan Berhasil dikirim']);
    }
}
