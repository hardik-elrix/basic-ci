<?php
defined('BASEPATH') or exit('No direct script access allowed');

function dFyDate($dateTime)
{
    $line = substr($dateTime, 0, 10) == "0000-00-00" ? "" : date("d F, Y", strtotime($dateTime));
    return $line;
}

function dFyhiA($dateTime)
{
    $line = substr($dateTime, 0, 10) == "0000-00-00" ? "" : date("d F, Y H:i", strtotime($dateTime));
    return $line;
}

function dmyHis($dateTime)
{
    $line = substr($dateTime, 0, 10) == "0000-00-00" ? "" : date("d-m-Y H:i:s", strtotime($dateTime));
    return $line;
}
function ymdHi($dateTime)
{
    $line = substr($dateTime, 0, 10) == "0000-00-00" ? "" : date("Y-m-d H:i", strtotime($dateTime));
    return $line;
}
function dmyHi($dateTime)
{
    $line = substr($dateTime, 0, 10) == "0000-00-00" ? "" : date("d-m-Y H:i", strtotime($dateTime));
    return $line;
}

function ymd($dateTime)
{
    $line = substr($dateTime, 0, 10) == "0000-00-00" ? "" : date("Y-m-d", strtotime($dateTime));
    return $line;
}
function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function showBalance($balance)
{
    return number_format($balance, 2, ".", "");
}

function passwordGenerator($length = 8)
{
    $randomString = substr(str_shuffle("ABCDEFGHJKMNPQRSTUVWXYZ123456789abcdefghjkmnpqrtuvwxyz"), 0, $length);
    return $randomString;
}
