<?php
// Create a new class for the controller (that will be linked to the "address" table in our case)
class Legalmentions extends Controller
{
    // Define a public function
    public function legalmentions()
    {
        // Sending data to the view
        $this->render('legalmentions');
    }
}
