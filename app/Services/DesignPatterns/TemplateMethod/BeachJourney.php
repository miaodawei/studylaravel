<?php


namespace App\Services\DesignPatterns\TemplateMethod;

/**
 * Class BeachJourney
 * @package App\Services\DesignPatterns\TemplateMethod
 * BeachJourney类（在海滩度假）
 */
class BeachJourney extends Journey
{
    protected function enjoyVacation()
    {
        echo "Swimming and sun-bathing\n";
    }
}
