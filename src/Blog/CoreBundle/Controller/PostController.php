<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     *
     * @return array
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository("ModelBundle:Post")->findAll();
        $latestPosts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findLatest(5);

        return array(
            'posts' => $posts,
            'latestPosts' => $latestPosts,
        );
    }


    /**
     * Show a post
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     *
     * @return array
     *
     * @Route("/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('ModelBundle:Post')->findOneBy(
            array(
                'slug' => $slug
            )
        );

        if (null === $post) {
            throw $this->contentNotFoundException('Post Not found');
        }

        return array(
            'post' => $post,
        );
    }

}
