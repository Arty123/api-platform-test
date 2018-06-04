<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login_check", name="api_login_check")
     */
    public function loginCheckAction()
    {
        // use login_check from lexikJWT bundle to get token
    }
}
