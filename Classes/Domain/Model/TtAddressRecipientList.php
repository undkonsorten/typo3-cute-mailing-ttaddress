<?php

namespace Undkonsorten\CuteMailingTtAddress\Domain\Model;

use FriendsOfTYPO3\TtAddress\Domain\Repository\AddressRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use Undkonsorten\CuteMailing\Domain\Model\RecipientList;
use Undkonsorten\CuteMailing\Domain\Model\RecipientListInterface;
use Undkonsorten\CuteMailingRegisteraddress\Domain\Repository\RegisteraddressRecipientRepository;
use Undkonsorten\CuteMailingTtAddress\Domain\Repository\TtAddressRecipientRepository;

class TtAddressRecipientList extends RecipientList implements RecipientListInterface
{

    /**
     * @inheritDoc
     */
    public function getRecipients(int $limit = null, int $offset = null): array
    {
        $result = [];
        /**@var $addressRepository TtAddressRecipientRepository * */
        $addressRepository = GeneralUtility::makeInstance(TtAddressRecipientRepository::class);
        /**@var $defaultQuerySettings Typo3QuerySettings* */
        $defaultQuerySettings = $this->defaultQuerySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $defaultQuerySettings->setRespectStoragePage(true);
        $defaultQuerySettings->setStoragePageIds([$this->getRecipientListPage()]);
        $addressRepository->setDefaultQuerySettings($defaultQuerySettings);
        $result = $addressRepository->findAll($limit, $offset)->toArray();

        return $result;
    }

    /**
     * @return int
     */
    public function getRecipientsCount(): int
    {
        /**@var $addressRepository AddressRepository * */
        $addressRepository = GeneralUtility::makeInstance(RegisteraddressRecipientRepository::class);
        /**@var $defaultQuerySettings Typo3QuerySettings* */
        $defaultQuerySettings = $this->defaultQuerySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $defaultQuerySettings->setRespectStoragePage(true);
        $defaultQuerySettings->setStoragePageIds([$this->getRecipientListPage()]);
        $addressRepository->setDefaultQuerySettings($defaultQuerySettings);
        return $addressRepository->findAll()->count();
    }

    /**
     * @inheritDoc
     */
    public function getRecipient(int $recipient): ?TtAddressRecipient
    {
        $result = null;

        /**@var $addressRepository TtAddressRecipientRepository * */
        $addressRepository = GeneralUtility::makeInstance(TtAddressRecipientRepository::class);
        /**@var $defaultQuerySettings Typo3QuerySettings* */
        $defaultQuerySettings = $this->defaultQuerySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $defaultQuerySettings->setRespectStoragePage(true);
        $defaultQuerySettings->setStoragePageIds([$this->getRecipientListPage()]);
        $addressRepository->setDefaultQuerySettings($defaultQuerySettings);
        /** @var TtAddressRecipient $result */
        $result = $addressRepository->findByUid($recipient);
        return $result;
    }
}
