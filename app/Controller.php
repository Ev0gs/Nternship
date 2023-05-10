<?php
    // We create a new abstract class that other controllers will inherit
    abstract class Controller{
        
        // Define function to load the model that matches
        public function loadModel(string $model){

            // Take the file that match with the model wanted
            require_once(ROOT.'models/'.$model.'.php');

            // We instantiate the model
            $this->$model = new $model();
        }

        // Define function to send data into a file (or render it)
        public function render(string $file, array $data = [])
        {
            // We extract data from the array
            extract($data);

            // Generate the view
            require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$file.'.php');
        }
        public function render2data(string $file, array $data = [], array $data1 = [])
        {
            // We extract data from the array
            extract($data);
            extract($data1);

            // Generate the view
            require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$file.'.php');
        }

        public function render5data(string $file, array $data = [], array $data1 = [], array $data2 = [], array $data3 = [], array $data4 = [])
        {
            // We extract data from the array
            extract($data);
            extract($data1);
            extract($data2);
            extract($data3);
            extract($data4);

            // Generate the view
            require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$file.'.php');
        }
    }
?>