<?php

namespace App\Enums;


use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum QuestionTypeEnum: int
{
    use Values, Names;

    case tfQuiz = 1;
    case multiSelect = 2;
    case match = 3;
    case fillGap = 4;
    case sort = 5;
    case langSort = 6;
}
