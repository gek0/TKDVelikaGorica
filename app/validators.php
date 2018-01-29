<?php

Validator::extend('alpha_spaces_dash', function($attribute, $value, $parameters)
{
    return preg_match('/^[\/\pL0-9\s\-@.]+$/u', $value);
});