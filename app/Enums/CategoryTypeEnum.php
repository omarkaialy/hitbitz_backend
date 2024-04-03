<?php
namespace App\Enums;
enum CategoryTypeEnum:int{
    use \ArchTech\Enums\Values,\ArchTech\Enums\Names;
    case prof=1;
    case learn=2;
}
