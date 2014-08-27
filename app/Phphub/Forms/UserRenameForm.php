<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class UserRenameForm extends FormValidator
{
    protected $rules = [
        'name'        => 'alpha_num|required|unique:users'
    ];
}
