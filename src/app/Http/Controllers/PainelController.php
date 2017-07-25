<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function inicial()
    {
    	if(auth()->user()->medico)
    		return redirect('medicos/dia');
    	return view('painel');
    }
}
