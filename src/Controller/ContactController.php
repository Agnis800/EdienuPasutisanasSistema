<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class ContactController {
    public function contactAction(Request $request) {

        return render_template($request, 'contactform.html');

    }
}