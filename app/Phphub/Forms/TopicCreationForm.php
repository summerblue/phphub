<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class TopicCreationForm extends FormValidator
{
    protected $rules = [
		'title'   => 'required|min:5',
		'body'    => 'required|min:10',
		'node_id' => 'required|numeric'
    ];
}