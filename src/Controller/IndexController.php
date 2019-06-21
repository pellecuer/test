<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {        
        $currentMonth = new \DateTime('now');
        $startProjectDate = new \DateTimeImmutable('2019-01-01');
        $endProjectDate = new \DateTime('2019-11-01');
        $intervalOneMonth = new \DateInterval('P1M');

        // calendar
        $calendars = [];
        $dt = clone $startProjectDate;
        while ($dt < $endProjectDate) {            
            $calendars[] = $dt->format('M-y');            
            $dt = $dt->add($intervalOneMonth);
        }
        //dump($calendars);die;

        //works
        $works = [            
            ['Gestion de projet', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Junior', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Design', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Lead', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Confirmé', 15, 1, 2, 2, 0, 2, 3, 4, 4, 4],            
            ['Quality Assurance', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Web', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Mobile Android', 3, 1, 2, 2, 0, 2, 3, 4, 4, 4],           
        ];  

        $key = array_search($currentMonth->format('M-y'), $calendars)+1;

        return $this->render('index/index.html.twig', [            
            'calendars' => $calendars,
            'key' => $key,
            'currentMonth' => $currentMonth->format('M-y'),
            'works' => $works
        ]);
    }

    /**
     * @Route("/ajax", name="ajax")
     */
    public function ajax(Request $request)
    {   
        // $currentMonth = $request->request->get('currentMonth');
        
        $works = [            
            ['Gestion de projet', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Junior', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Design', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Lead', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Confirmé', 15, 1, 2, 2, 0, 2, 3, 4, 4, 4],            
            ['Quality Assurance', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Web', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Mobile Android', 3, 1, 2, 2, 0, 2, 3, 4, 4, 4],           
        ];                

        return $this->json(
            [ 
                'data' => $works,              
            ]
        );
    }


    /**
     * @Route("/response", name="response")
     */
    public function response(Request $request)
    {         
        //get new rank
        $rank = $request->request->get('rank');


        $response = new Response(json_encode([
            'rank' =>  $rank
        ]));

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    


}
