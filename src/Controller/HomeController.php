<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;


class HomeController {

    public function homeAction(Request $request) {

        return render_template($request, 'home.html');
    }

}