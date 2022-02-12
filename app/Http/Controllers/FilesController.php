<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index() {
        return view("files");
    }

    public function store() {
        dd("this is the store method");
    }
}
