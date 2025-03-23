<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminProductController extends AbstractController
{
    //route pour tous les produits
    #[Route('/admin/product', name: 'admin_product')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository ->findAll();
           
        return $this->render('admin_product/index.html.twig', [
            'products' => $products,
        ]);
    }
    // route pour un produit(show voir item)
    #[Route('/admin/product/{id}', name: 'admin_product_show')]
    public function show($id, ProductRepository $productRepository,CategoryRepository $categoryRepository): Response
    {
        $product = $productRepository ->find($id);
        return $this->render('admin_product/show.html.twig', [
            'product' => $product,
        ]);
    }
    // route pour ajouter un produit
    #[Route('/admin/add_product', name: 'admin_add_product')]
    public function addProduct(EntityManagerInterface $entity_manager,Request $request): Response
    {
        $product = new Product();
        $form = $this-> createForm(ProductType::class,$product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entity_manager->persist($product);
            $entity_manager->flush();

            return $this->redirectToRoute('admin_product');
        }
           
        return $this->render('admin_product/add.html.twig', [
            'product' => $product,
            'form'=>$form->createView()
        ]);
    }

    //route pour supprimer un produit
    #[Route('/admin/remove_product/{id}', name: 'admin_remove_product')]
    public function removeProduct($id,ProductRepository $productRepository,
    EntityManagerInterface $entity_manager): Response
    {
        $product = $productRepository->find($id);        
        $entity_manager->remove($product);

        $entity_manager->flush();

        return $this->redirectToRoute('admin_product');
        
    }
    // route pour editer (update) un produit
    #[Route('/admin/edit_product/{id}', name: 'admin_edit_product')]
    public function editProduct($id,ProductRepository $productRepository,
    EntityManagerInterface $entity_manager,Request $request): Response
    {
        $product = $productRepository->find($id);
        $form = $this->createForm(ProductType::class,$product);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entity_manager->remove($product);
            $entity_manager->flush();

            return $this->redirectToRoute('admin_product');
        }    

        return $this->render('admin_product/edit.html.twig',[
            'product' => $product,
            'form' => $form->createView() 
        ]);
    }          
        
    };

