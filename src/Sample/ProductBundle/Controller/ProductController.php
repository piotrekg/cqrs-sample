<?php

namespace Sample\ProductBundle\Controller;

use Knp\Component\Pager\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request)
    {
        $paginator = new Paginator();
        $result = $paginator
            ->paginate(
                $this->get('product.repository')->findAllQuery(),
                $request->query->getInt('page', 1)
            )
        ;

        return $this->render('default/list.html.twig', [
            'result' => $result,
        ]);
    }
}
