<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;


class LoginController {

    public function loginAction(Request $request) {

        return render_template($request, 'login.php');
    }

}