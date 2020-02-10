<?php


namespace App\Services\DesignPatterns\Composite;


use phpDocumentor\Reflection\Types\Integer;

class Leaf extends Component
{

    public function add(Component $c)
    {
        print_r('不能再增加叶子节点！');
    }

    public function remove(Component $c)
    {
        print_r('不能移除一个叶子节点！');
    }

    public function display(int $dept)
    {
        echo str_repeat('-', $dept).$this->name.'<br>';
    }
}
