<?php
namespace App\Controller;

use App\Entity\Posts;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog')]
final class BlogController extends AbstractController
{
#[Route('/', name: 'blog_index', methods: ['GET'])]
public function index(PostsRepository $postsRepository): Response
{
$latestPosts = $postsRepository->findAll(); // Fetch all posts from the repository

return $this->render('blog/index.html.twig', [
'posts' => $latestPosts, // Pass the posts to the template
]);
}

#[Route('/posts/{id}', name: 'blog_post', methods: ['GET'])]
public function postShow(Posts $post): Response
{
return $this->render('blog/post_show.html.twig', [
'post' => $post,
]);
}
}
