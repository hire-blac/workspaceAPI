<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
      return $id ? Space::find($id) : Space::all();
    }

    public function store(Request $request)
    {
        $space = new Space;
        $space->space_name = $request->space_name;
        $space->space_type = $request->space_type;
        $response = $space->save();

        return $response ? ["response"=>"object saved"] : ["response"=>"error occured"];
    }

    public function update(Request $request, $id)
    {
      $space = Space::find($id);
      $space->space_name = $request->space_name;
      $space->space_type = $request->space_type;
      $response = $space->save();

      return $response ? ["response"=>"object updated"] : ["response"=>"error occured"];
    }

    public function destroy($id)
    {
        $space = Space::find($id);
        $response = $space->delete();

        return $response ? ["response"=>"object deleted"] : ["response"=>"error occured"];
    }
}
