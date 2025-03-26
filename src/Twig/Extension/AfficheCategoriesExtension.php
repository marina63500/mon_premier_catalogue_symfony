<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\AfficheCategoriesRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AfficheCategoriesExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [AfficheCategoriesRuntime::class, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_categories', [AfficheCategoriesRuntime::class, 'getCategories']),
        ];                          //twig                                                          //php dans runtime
    }
}
