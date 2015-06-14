<?php
function get_image_name(){
    static $imageCount = 0;
    $imageCount++;
    return time().rand(10000, 999999) . $imageCount;
}