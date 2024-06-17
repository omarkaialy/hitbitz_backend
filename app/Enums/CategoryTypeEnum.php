<?php
namespace App\Enums;
enum CategoryTypeEnum:int{
    use \ArchTech\Enums\Values,\ArchTech\Enums\Names;
    case learn=1;
    case prof=2;
}
