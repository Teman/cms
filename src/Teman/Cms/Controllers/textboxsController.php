<?php namespace Teman\Cms\Controllers;

use Teman\Cms\Forms\UserForm;
use Teman\Cms\Models\Entrust\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Teman\Cms\Models\Entrust\User;
use Mews\Purifier\Facades\Purifier;


class TextboxsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /textboxs
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('cms::textboxs.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /textboxs/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /textboxs
	 *
	 * @return Response
	 */
	public function store()
	{
        /*
             * Purifier the input given in the richtextbox editor
             * for extra config see mews/purifier/src/config/config.php
        */


		$input = Input::only('richTextBoxEditorSimple');
        //dd($input);
        $output = \Mews\Purifier\Purifier::clean($input,'simple');


        /*
             * As second param you can chose between 'simple','basic','advanced'
             * according to the textbx editor
             * $output = \Mews\Purifier\Purifier::clean($input,'simple');
             * $output = \Mews\Purifier\Purifier::clean($input,'basic');
             * $output = \Mews\Purifier\Purifier::clean($input,'advanced');
         */

        dd($output);

	}

	/**
	 * Display the specified resource.
	 * GET /textboxs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /textboxs/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /textboxs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /textboxs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}