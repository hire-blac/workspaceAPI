<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpaceType;

class SpaceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        return $id ? SpaceType::find($id) : SpaceType::all();
    }

    public function store(Request $request)
    {
        $spaceType = new SpaceType;
        $spaceType->space_type_name = $request->space_type_name;
        $response = $spaceType->save();

        return $response ? ["response"=>"object saved"] : ["response"=>"error occured"];
    }

    public function update(Request $request, $id)
    {
      $spaceType = SpaceType::find($id);
      $spaceType->space_type_name = $request->space_type_name;
      $response = $spaceType->save();

      return $response ? ["response"=>"object updated"] : ["response"=>"error occured"];
    }

    public function destroy($id)
    {
        $spaceType = SpaceType::find($id);
        $response = $spaceType->delete();

        return $response ? ["response"=>"object deleted"] : ["response"=>"error occured"];
    }
}
