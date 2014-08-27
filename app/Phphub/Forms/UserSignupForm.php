<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class UserSignupForm extends FormValidator
{
    protected $rules = [
        'github_id'   => 'required|unique:users',
        'github_name' => 'required',
        'name'        => 'alpha_num|required|unique:users',
        'email'       => 'email'
    ];
}
