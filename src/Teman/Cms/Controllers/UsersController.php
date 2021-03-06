<?php namespace Teman\Cms\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Teman\Cms\Forms\UserForm;
use Teman\Cms\Models\Entrust\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Teman\Cms\Models\Entrust\User;
use Laracasts\Flash\Flash;
use Teman\Cms\Libraries\PasswordSet;


use \Laracasts\Validation\FormValidationException;

class UsersController extends BaseController {

    protected $userForm;

    function __construct(UserForm $userForm)
    {
        $this->userForm = $userForm;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        set_page_title('Users overview');
        $users = User::has('roles')->simplePaginate(20);


        return View::make('cms::admin.users.index')->withUsers($users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $roles = Role::all();

        return View::make('cms::admin.users.create')->withRoles($roles);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
    {

        //if no password is set, keep previous
        $input = Input::all();
        if (!Input::get('set_password')) {
            //manually setting password
            $password_validation = 'required|' . Config::get('cms::auth.password_validation_' . Config::get('cms::auth.password_validation'));
        }else{
            //password set automatically (temp)
            $password_validation = '';
        }

        //own validator because unique rule is different for create or update
        $validator = Validator::make( $input, [
            'email' => 'required|'.Config::get('cms::auth.user_validation').'|unique:'.Config::get('cms::table_prefix').'users',
            'password' => $password_validation,
            'role_id' => 'required|integer'
        ] );

        if ( $validator->fails() ){
            throw new FormValidationException('Validation failed', $validator->errors());
        }


        $user = new User;
        $user->email = Input::get('email');
        if (Input::get('set_password')){
            //send email..
            $user = PasswordSet::setPasswordAndSendMail($user);
        }else{
            $user->password = Input::get('password');
        }

        if ( ! $user->save() ){
            return Redirect::back()->withErrors( $user->errors() );
        }

        $user->attachRole( Input::get('role_id') );
        //now user is saved set password expiry again to save history
        $user->setPasswordExpiry()->save();


        Flash::success('User created');
        return Redirect::route('admin.users.index');
	}


	/**
	 * Display the specified resource.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//

        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return View::make('cms::admin.users.edit')
            ->withUser($user)
            ->withRoles($roles);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
     * @throws FormValidationException
	 */
	public function update($id)
	{
		//TODO update: use Ardent

        $user = User::findOrFail($id);

        //if no password is set, keep previous
        $input = Input::all();
        if ( ! $input['password'] ){
            $input = Input::except('password');
        }

        //own validator because unique rule is different for create or update
        $validator = Validator::make( $input, [
                'email' => 'required|'.Config::get('cms::auth.user_validation').'|unique:'.Config::get('cms::table_prefix').'users,id,' . $id,
                'password' => Config::get('cms::auth.password_validation_'.Config::get('cms::auth.password_validation')),
                'role_id' => 'required|integer'
        ] );

        if ( $validator->fails() ){
            throw new FormValidationException('Validation failed', $validator->errors());
        }

        $user->update($input);

        $role = Role::findOrFail(Input::get('role_id'));
        if ( ! $user->hasRole( $role->name )){
            $user->detachRoles( $user->roles );
            $user->attachRole( $role->id );
        }
        Flash::success('User updated');
        return Redirect::route('admin.users.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//

        $user = User::findOrFail($id);

        $user->delete();
        Flash::success('User removed');
        return Redirect::route('admin.users.index');
	}


}
