<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Persona;
use Response;

class PersonaController extends Controller {

	public function json(){
		$posts= Persona::where('nombres','like','%c%')->paginate(5);
		return Response::json($posts);
	}
	
}
