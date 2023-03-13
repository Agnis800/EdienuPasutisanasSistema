<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;


class RegisterController {

    public function RegisterAction(Request $request) {

        return render_template($request, 'register.php');
    }

}