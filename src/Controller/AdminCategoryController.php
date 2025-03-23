<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;






final class AdminCategoryController extends AbstractController
{
    // route pour les listes de categories
    #[Route('/admin/category', name: 'admin_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin_category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
        // route pour une categorie pour voir(show)
    #[Route('/admin/category/{id}', name: 'admin_category_item')]
    public function item($id,CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->find($id);
       

        return $this->render('admin_category/item.html.twig', [
            'category' => $category,
        ]);
    }
         // route pour ajouter (add)
    #[Route('/admin/add_category', name: 'admin_add_category')]
    public function add(EntityManagerInterface $entityManager ,Request $request): Response
    {
        $category= new Category();
        $form = $this->createForm(CategoryType::class,$category);   
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);        
            $entityManager->flush();
        }
       

        return $this->render('admin_category/add.html.twig', [
            'category' => $category,
            'form' =>$form->createView()
        ]);
    }

        // route pour supprimer (remove)
    #[Route('/admin/remove_category/{id}', name: 'admin_remove_category')]
    public function removeCategory($id,CategoryRepository $categoryRepository,
    EntityManagerInterface $entityManager): Response
    {
        
        $category = $categoryRepository->find($id  );       
        $entityManager->remove($category);
        
        $entityManager->flush();

        return $this->redirectToRoute('admin_category');     
      
    }

    // route pour update une categorie(edit)
    #[Route('/admin/edit_category/{id}', name: 'admin_edit_category')]
    public function editCategory($id,CategoryRepository $categoryRepository,
    EntityManagerInterface $entityManager,Request $request): Response
    {
        $category = $categoryRepository->find($id  ); 
        $form = $this->createForm(CategoryType::class,$category);   
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);        
            $entityManager->flush();
        }                          

        return $this->render('admin_category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView()
        ]);
    }
}
