<?php

class Node extends \Eloquent
{
    const CACHE_KEY     = 'site_nodes';
    const CACHE_MINUTES = 60;

    protected $fillable = [];

    public function topics($filter)
    {
        return $this->hasMany('Topic')->getTopicsWithFilter($filter);
    }

    public static function allLevelUp()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_MINUTES, function () {
            $nodes = Node::all();

            $result = array();
            foreach ($nodes as $key => $node) {
                if ($node->parent_node == null) {
                    $result['top'][] = $node;
                    foreach ($nodes as $skey => $snode) {
                        if ($snode->parent_node == $node->id) {
                            $result['second'][$node->id][] = $snode;
                        }
                    }
                }
            }
            return $result;
        });
    }
}
