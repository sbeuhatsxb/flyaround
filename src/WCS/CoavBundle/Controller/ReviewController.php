<?php

namespace WCS\CoavBundle\Controller;

use WCS\CoavBundle\Entity\Review;
use WCS\CoavBundle\Entity\Flight;
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
    *
    * @Route("{review_id}/flight/{flight_id}", name="review_index", requirements={"review_id": "\d+"})
    * @Method("GET");
    * @ParamConverter("review",   options={"mapping": {"review_id": "id"}})
    * @ParamConverter("flight",   options={"mapping": {"flight_id": "id"}})
    */
    public function indexAction(Flight $flight)
    {
       return $this->render('review/index.html.twig', array(
           'review' => $review,
           'flight' => $flight,
       ));
    }

    /**
    *
    * @Route("/new", name="review_new")
    * @Method("POST");
    */
    public function newAction(Flight $flight)
    {
       return $this->render('review/new.html.twig', array(
               'review' => $review,
               'flight' => $flight,
       ));
    }
}
