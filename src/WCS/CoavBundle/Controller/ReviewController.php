<?php

namespace WCS\CoavBundle\Controller;

use WCS\CoavBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
* Review controller.
*
* @Route("review")
*/
class ReviewController extends Controller
{

    /**
     * @Route("/", name="review_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('WCSCoavBundle:Review')->findAll();
        return $this->render('review/index.html.twig', array(
            'reviews' => $reviews
       ));
    }

    /**
     * @Route("/new", name="review_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {

        $reservation = new Review();
        $form = $this->createForm('WCS\CoavBundle\Form\FormType', $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->render('review/new.html.twig', array(
                'reviews' => $reviews
            ));
        }
        return $this->render('review/new.html.twig', array(
            'reviews' => $reviews,
            'form' => $form->createView(),
       ));
    }
}
