<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Clean query strings and protocols from urls
 * Returns only hostname
 */

function sendEmail_($subject, $message, $to)
{
    $CI =& get_instance();
    $CI->load->library('email');
    $CI->email->from($CI->config->item('from'), $CI->config->item('label'));
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);
    $CI->email->send();
    return true;
}
