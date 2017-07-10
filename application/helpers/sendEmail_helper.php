<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Clean query strings and protocols from urls
 * Returns only hostname
 */

function sendEmail_($subject, $message)
{
    $CI =& get_instance();
    $CI->load->library('email');
    $CI->email->from($CI->config->item('from'), $CI->config->item('label'));
    $CI->email->to('rifky.rachman@yahoo.com');
    // $this->email->cc('another@another-example.com');
    // $this->email->bcc('them@their-example.com');
    $CI->email->subject($subject);
    $CI->email->message($message);
    $CI->email->send();
    return true;
}
