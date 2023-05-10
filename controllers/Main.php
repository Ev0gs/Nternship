<?php
    // Create a new class for the Main controller (first page of our website in our case)
    class Main extends Controller
    {
        // Define a default function that will simply load the index view from "/views/main" folder
        public function index()
        {
            // Load the 'index' view from main page (so the first page of our website)
            $this->render('index');
        }
    }
?>