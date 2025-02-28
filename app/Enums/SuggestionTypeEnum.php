<?php
namespace App\Enums;
enum SuggestionTypeEnum:int{
    use \ArchTech\Enums\Values,\ArchTech\Enums\Names;
    case feedback=1;
    case report=2;
    case suggestion=3;
}
