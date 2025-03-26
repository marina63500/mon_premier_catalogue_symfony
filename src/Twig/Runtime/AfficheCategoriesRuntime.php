<?php

namespace App\Twig\Runtime;

use App\Repository\CategoryRepository;
use Twig\Extension\RuntimeExtensionInterface;

class AfficheCategoriesRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private CategoryRepository $categoryRepository)
    {
        // Inject dependencies if needed
    }

    public function getCategories(): array
    {
        $categories = $this->categoryRepository->findAll();
        return $categories;
    }
}
