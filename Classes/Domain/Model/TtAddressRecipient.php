<?php

namespace Undkonsorten\CuteMailingTtAddress\Domain\Model;




use FriendsOfTYPO3\TtAddress\Domain\Model\Address;
use Undkonsorten\CuteMailing\Domain\Model\RecipientInterface;

class TtAddressRecipient extends Address implements RecipientInterface
{

    #[\Override]
    public function getUid(): int
    {
        return parent::getUid();
    }
}
