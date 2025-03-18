<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


 #[Route('/shop')]
final class ShopController extends AbstractController
{
    #[Route('', name: 'shop_index')]
    public function index(ProductRepository $productRepository,CategoryRepository $category_repository): Response
    {        
        $products = $productRepository->findAll();
        $categories = $category_repository->findAll();
      
        return $this->render('shop/index.html.twig', [
            'products' => $products,
            'categories'=> $categories,
        ]);
    }      

    
    #[Route('/product/{id}', name: 'shop_product')]
    public function product( ProductRepository $product_repository,$id): Response
    {        
        $product = $product_repository->find($id);
       
        return $this->render('shop/product.html.twig', [
            'product' => $product,
        ]);
    }


    #[Route('/category/{id}', name: 'shop_category')]
    public function category(CategoryRepository $category_repository,$id): Response
    {
        
        $categories = $category_repository->find($id);            
       
        return $this->render('shop/category.html.twig', [
            'categories' => $categories,
        ]);
    }
}
