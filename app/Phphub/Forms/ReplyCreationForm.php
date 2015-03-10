<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class ReplyCreationForm extends FormValidator
{
    protected $rules = [
        'body'     => 'required|min:2',
        'user_id'  => 'required|numeric',
        'topic_id' => 'required|numeric',
    ];
}
