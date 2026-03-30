<?php

namespace App\Enums;

enum QuestOutcome: string
{
    case Success = 'success';
    case Failure = 'failure';
    case Abandoned = 'abandoned';
}
