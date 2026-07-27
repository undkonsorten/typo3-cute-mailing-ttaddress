<?php

declare(strict_types=1);

namespace Undkonsorten\CuteMailingTtAddress\Domain\Repository;

use FriendsOfTYPO3\TtAddress\Domain\Repository\AddressRepository;

class TtAddressRecipientRepository extends AddressRepository
{
    #[\Override]
    public function findAll(?int $limit = null, ?int $offset = null)
    {
        $query = $this->createQuery();
        if(!is_null($limit) && $limit > 0){
            $query->setLimit($limit);
        }
        if(!is_null($offset) && $offset >0){
            $query->setOffset($offset);
        }
        return $query->execute();
    }

}
