<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class CartController {
    public function cartAction(Request $request) {

        return render_template($request, 'cart.php');

    }
}