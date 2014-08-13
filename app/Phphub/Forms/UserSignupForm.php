<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class UserSignupForm extends FormValidator
{
	
    protected $rules = [
		'github_id' => 'required|unique:users',
		'name'      => 'required',
		'email'     => 'email'
    ];
}