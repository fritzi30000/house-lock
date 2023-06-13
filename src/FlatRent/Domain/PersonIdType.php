<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

enum PersonIdType: string
{
    case PASSPORT = 'PASSPORT';
    case ID_CARD = 'ID_CARD';
}
