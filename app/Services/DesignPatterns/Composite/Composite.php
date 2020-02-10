<?php


namespace App\Services\DesignPatterns\Composite;


class Composite extends Component
{

    private $children = [];

    public function add(Component $c)
    {
        $this->children[] = $c;
    }

    public function remove(Component $c)
    {
        unset($this->children[array_search($c, $this->children)]);
    }

    public function display(int $dept)
    {
        echo str_repeat('-', $dept).$this->name.'<br>';
        foreach($this->children as $child) {
            $child->display($dept + 2);
        }
    }
}
