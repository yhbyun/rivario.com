<?php namespace API;

use App;
use Input;
use Person;
use Validator;

class PersonsController extends \BaseController
{
    public function __construct()
    {
    }


    /**
     * Display a listing of the resource.
     * GET /persons
     *
     * @return Response
     */
    public function index()
    {
        return Person::all();
    }

    /**
     * Show the form for creating a new resource.
     * GET /persons/create
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * POST /persons
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name' => 'required',
            'age' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            App::abort('422');
        }

        $person = new Person();
        $person->name = Input::get('name');
        $person->age = Input::get('age');
        $person->save();

        return $person;
    }

    /**
     * Display the specified resource.
     * GET /persons/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $person = Person::find($id);
        if (! $person) {
            App::abort('404');
        }

        return $person;
    }

    /**
     * Show the form for editing the specified resource.
     * GET /persons/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * PUT /persons/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $person = Person::find($id);
        if (! $person) {
            App::abort('404');
        }

        $rules = array(
            'name' => 'required',
            'age' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            App::abort('422');
        }

        $person->name = Input::get('name');
        $person->age = Input::get('age');
        $person->save();

        return $person;
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /persons/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Person::destroy($id);

        return Response::json('', '200');
    }
}
