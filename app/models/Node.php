<?php

class Node extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function topics($filter) 
	{
		return $this->hasMany('Topic')->getTopicsWithFilter($filter);;
	}

	public static function allLevelUp()
	{
		$nodes = Node::all();

		$result = array();
		foreach ($nodes as $key => $node) {
			if ( $node->parent_node == null ) {
				$result['top'][] = $node;
				foreach ($nodes as $skey => $snode) {
					if ($snode->parent_node == $node->id) {
						$result['second'][$node->id][] = $snode;
					}
				}
			}
		}
		return $result;
	}

}