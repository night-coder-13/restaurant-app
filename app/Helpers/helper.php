<?php

function ImageUrl($image) {
    return env('ADMIN_PANEL_URL') . env('PUBLIC_URL') . $image;
}

function salePercent($price , $sale){
    return round((($price - $sale) / $price) * 100);
}