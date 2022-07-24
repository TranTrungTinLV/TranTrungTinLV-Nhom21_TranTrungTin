<?php

    function check_empty_fields($required_fields_array){
        //initial an arr to store error messages
        $form_errors = array();

        foreach($required_fields_array as $name_of_field){
            if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL ){
                $form_errors[] = $name_of_field . "is a required field";
            }
        }
        return $form_errors;
    }

    function check_min_length($feilds_to_check_length){
        //initialize an array to store error messages
        $form_errors = array();
        foreach($feilds_to_check_length as $name_of_field => $minium_length_required){
            if(strlen(trim($_POST[$name_of_field])) < $minium_length_required){
                $form_errors[] = $name_of_field . " is too short, must be {$minium_length_required} character long";
            }
        }
        return $form_errors;
    }

    function check_email($data){
        //initialize an arr to store error mess
        $form_errors = array();
        $key = 'email';
        // check if the key email exist in data arr
        if(array_key_exists($key , $data)){
            //check if the email feild has a value
            if($_POST[$key] != null){
                //Remove all illegal character from email
                $key = filter_var($key, FILTER_SANITIZE_EMAIL);

                // check if input is a valid email address
                if(filter_var($_POST[$key], FILTER_SANITIZE_EMAIL) === false){
                    $form_errors[] = $key. "is not a valid email address";
                }
            }
        }
        return $form_errors;
    }

    function show_errors($form_errors_array){
        $errors = "<p><ul style = 'color : red;'>";

        foreach($form_errors_array as $the_error){
            $errors .= "<li>{$the_error}</li>";
        };
        $errors .= "<p></p>";
        return $errors;
    }
    ?>