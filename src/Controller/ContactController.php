<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class ContactController {
    public function contactAction(Request $request) {

        $output = '<html>
        <body>
        
        Welcome <?php echo $_POST["name"]; ?><br>
        Your email address is: <?php echo $_POST["email"]; ?>
        
        </body>
        
        </html>';


        die("hello from controller");
    }
}