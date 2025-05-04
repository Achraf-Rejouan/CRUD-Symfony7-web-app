<?php

namespace App\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleType;
use App\Entity\Categorie;
use App\Form\CategorieType;


class IndexController extends AbstractController
{
    #[Route('/categorie/new', name: 'new_categorie', methods: ['GET', 'POST'])]
    public function newCategorie(Request $req, EntityManagerInterface $em): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $em->getRepository(Categorie::class);
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('article_list');
        }
        return $this->render('articles/newCategorie.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('/', name: 'article_list')]
    public function home(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Article::class)->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/article/save', name: 'addArticle')]
    public function save(EntityManagerInterface $em): Response
    {
        $article = new Article();
        $article->setNom('Article 1');
        $article->setPrix(1000);

        $em->getRepository(Article::class);
        $em->persist($article);
        $em->flush();

        return new Response('Article enregistré avec id ' . $article->getId());
    }

    #[Route('/article/new', name: 'new_article', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $em->getRepository(Article::class);
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article_list');
        }
        return $this->render('articles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/article/{id}', name: 'article_show')]
    public function show($id, EntityManagerInterface $em): Response
    {
        $article = $em->getRepository(Article::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }
        return $this->render('articles/show.html.twig', array(
            'article' => $article
        ));
    }

    #[Route('/article/edit/{id}', name: 'article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id, EntityManagerInterface $em): Response
    {
        $article = $em->getRepository(Article::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }

        $form = $this->createFormBuilder($article)
            ->add('nom', TextType::class)
            ->add('prix', TextType::class)
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'titre',
                'label' => 'Catégorie',
                'placeholder' => 'Choisissez une catégorie'
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('article_list');
        }

        return $this->render('articles/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/article/delete/{id}', name: 'article_delete', methods: ['GET'])]
    public function delete(Request $request, $id, EntityManagerInterface $em): Response
    {
        $article = $em->getRepository(Article::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }

        $em->remove($article);
        $em->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('article_list');
    }
}
