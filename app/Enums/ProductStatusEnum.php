<?php

namespace App\Enums;

class ProductStatusEnum
{
    const DRAFT = 'Draft';
    const PUBLISHED = 'Published';
    const OOS = 'Out of Stock';

    const LIST = [
        1 => "Draft",
        2 => "Published",
        3 => "Out of Stock"
    ];
}