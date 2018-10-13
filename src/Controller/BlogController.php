<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{

    const POST_LIMIT = 5;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $authorRepository;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $blogPostRepository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
        $this->authorRepository = $entityManager->getRepository('App:Author');
    }

//    /**
//     * @Route("/", name="homepage")
//     */
//    public function indexAction()
//    {
//        return $this->render('blog/index.html.twig', [
//            'controller_name' => 'BlogController',
//        ]);
//    }

    /**
     * @Route("/", name="homepage")
     * @Route("/entries", name="entries")
     */
    public function entriesAction(Request $request)
    {
        $page = 1;

        if ($request->get('page')) {
            $page = $request->get('page');
        }

        return $this->render('blog/entries.html.twig', [
            'blogPosts' => $this->blogPostRepository->getAllPosts($page, self::POST_LIMIT),
            'totalBlogPosts' => $this->blogPostRepository->getPostCount(),
            'page' => $page,
            'entryLimit' => self::POST_LIMIT
        ]);
    }

    /**
     * @Route("/entry/{slug}", name="entry")
     */
    public function entryAction($slug)
    {
        $blogPost = $this->blogPostRepository->findOneBySlug($slug);

        if (!$blogPost) {
            $this->addFlash('error', 'Unable to find entry!');

            return $this->redirectToRoute('entries');
        }

        return $this->render('blog/entry.html.twig', array(
            'blogPost' => $blogPost
        ));
    }

    /**
     * @Route("/author/{name}", name="author")
     */
    public function authorAction($name)
    {
        $author = $this->authorRepository->findOneByUsername($name);

        if (!$author) {
            $this->addFlash('error', 'Unable to find author!');
            return $this->redirectToRoute('entries');
        }

        return $this->render('blog/author.html.twig', [
            'author' => $author
        ]);
    }
}
