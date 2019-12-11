<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route("/users", name="users_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("", name="list")
     * @param Request            $request
     * @param UserRepository     $userRepository
     * @param PaginatorInterface $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, UserRepository $userRepository, PaginatorInterface $paginator)
    {
        $pagination = $paginator->paginate(
            $userRepository->createQueryBuilder('u')->getQuery(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('users/list.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/{id}", name="disable")
     *
     * @param UserRepository $userRepository
     * @param                $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function disable(UserRepository $userRepository, $id)
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->redirectToRoute('users_list');
        }

        $user->setEnabled(false);
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush($user);

        return $this->redirectToRoute('users_list');
    }

}