<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class TopicCreationForm extends FormValidator
{
    protected $rules = [
        'title'   => 'required|min:2',
        'body'    => 'required|min:2',
        'node_id' => 'required|numeric'
    ];
}
