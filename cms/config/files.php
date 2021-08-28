<?php
return [
    "news_image" => [
        "path" => "news/image",
        "base_64" => true,
        "crop" => true,
        "max_width" => 1024,
        "sizes" => [
            "large" => [700, 460],
            "medium" => [343, 230],
            "small" => [137, 92]
        ]
    ],

    "news_banner" => [
        "path" => "news/banner",
        "base_64" => true,
        "crop" => true,
        "max_width" => 1600,
        "size" => [1600, 500]
    ],

    "branch_image" => [
        "path" => "branch",
        "base_64" => true,
        "crop" => true,
        "size" => [300, 145]
    ],

    "branch_icon" => [
        "path" => "branch",
        "base_64" => true,
        "crop" => false,
        "max_width" => 100
    ],

    "career_image" => [
        "path" => "career/image",
        "base_64" => true,
        "crop" => true,
        "max_width" => 1024,
        "sizes" => [
            "large" => [700, 460],
            "medium" => [343, 230],
            "small" => [137, 92]
        ]
    ],

    "career_banner" => [
        "path" => "career/banner",
        "base_64" => true,
        "crop" => true,
        "max_width" => 1600,
        "size" => [1600, 500]
    ],

    'career_attach_file' => [
        "path" => "career/apply",
    ],

    'catalogue' =>[
        "path" => "catalogue",
    ],

    "product_category_logo" => [
        "path" => "product-c",
        "base_64" => true,
        "max_width" => 400
    ],

    "product_category_icon" => [
        "path" => "product-c",
        "base_64" => true,
        "crop" => true,
        "size" => [350, 187]
    ],

    "product_category_image" => [
        "path" => "product-c",
        "base_64" => true,
        "crop" => true,
        "size" => [350, 350]
    ],

    "product_photo" => [
        "path" => "product",
        "base_64" => true,
        "crop" => true,
        "max_width" => 1024,
        "sizes" => [
            "large" => [900, 900],
            "medium" => [500, 500],
            "small" => [170, 170]
        ]
    ],

    "care_tip_icon" => [
        "path" => "product/care_tip",
        "base_64" => true
    ],

    "image360_image" => [
        "path" => "image360/image",
        "base_64" => true
    ],

    "image360_avatar" => [
        "path" => "image360/avatar",
        "base_64" => true,
        "crop" => true,
        "size" => [235, 140]
    ],

    "slider_image" => [
        "path" => "slider",
        "base_64" => true,
        "crop" => false,
        "max_width" => 1600,
        "sizes" => [
            "large" => [1600, null],
            "medium" => [500, null],
            "small" => [200, null]
        ]
    ],

    "gallery_file" => [
        "path" => "gallery/file"
    ],

    "gallery_avatar" => [
        "path" => "gallery/avatar",
        "base_64" => true,
        "crop" => true,
        "size" => [235, 140]
    ],

    'career_apply_resume' => [
        "path" => "career/apply/resume"
    ],


];