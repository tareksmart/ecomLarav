<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class get extends Controller
{
  public function get(){
    return 'select data';
  }
  public function post(){
    return 'post data';
  }

public function edit(){
    return 'edit data';
  }

}

