<?php

namespace Undkonsorten\CuteMailingTtAddress\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use Undkonsorten\CuteMailing\Domain\Model\RecipientList;
use Undkonsorten\CuteMailing\Domain\Model\RecipientListInterface;
use Undkonsorten\CuteMailingTtAddress\Domain\Repository\TtAddressRecipientRepository;

class TtAddressRecipientList extends RecipientList implements RecipientListInterface
{

    /**
     * @var Typo3QuerySettings
     */
    public $defaultQuerySettings;
    /**
     * @inheritDoc
     */
    public function getRecipients(?int $limit = null, ?int $offset = null): array
    {
        $result = [];
        /**@var $addressRepository TtAddressRecipientRepository * */
        $addressRepository = $this->getAddressRepository();
        $result = $addressRepository->findAll($limit, $offset)->toArray();

        return $result;
    }

    /**
     * @return int
     */
    public function getRecipientsCount(): int
    {
        /**@var $addressRepository AddressRepository * */
        $addressRepository = $this->getAddressRepository();
        return $addressRepository->findAll()->count();
    }

    /**
     * @inheritDoc
     */
    public function getRecipient(int $recipient): ?TtAddressRecipient
    {
        $result = null;
        $addressRepository = $this->getAddressRepository();
        /** @var TtAddressRecipient $result */
        $result = $addressRepository->findByUid($recipient);
        return $result;
    }

    /**
     * @param string $email
     * @return void
     * @throws IllegalObjectTypeException
     */
    public function removeRecipientByEmail(string $email): void
    {
        $addressRepository = $this->getAddressRepository();
        $result = $addressRepository->findOneBy(['email' => $email]);
        if(!is_null($result)){
            $addressRepository->remove($result);
        }
    }

    /**
     * @param int $recipient
     * @return void
     * @throws IllegalObjectTypeException
     */
    public function removeRecipientById(int $recipient): void
    {
        $addressRepository = $this->getAddressRepository();
        $result = $addressRepository->findByUid($recipient);
        if(!is_null($result)){
            $addressRepository->remove($result);
        }
    }

    /**
     * @param string $email
     * @return void
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    public function disableRecipientByEmail(string $email): void
    {
        $addressRepository = $this->getAddressRepository();
        $result = $addressRepository->findOneBy(['email' => $email]);
        $result->setHidden(true);
        $addressRepository->update($result);
    }

    /**
     * @param int $recipient
     * @return void
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    public function disableRecipientById(int $recipient): void
    {
        $addressRepository = $this->getAddressRepository();
        $result = $addressRepository->findByUid($recipient);
        $result->setHidden(true);
        $addressRepository->update($result);
    }

    /**
     * @return TtAddressRecipientRepository
     */
    protected function getAddressRepository(): TtAddressRecipientRepository
    {
        /**@var $addressRepository TtAddressRecipientRepository * */
        $addressRepository = GeneralUtility::makeInstance(TtAddressRecipientRepository::class);
        /**@var $defaultQuerySettings Typo3QuerySettings* */
        $defaultQuerySettings = $this->defaultQuerySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $defaultQuerySettings->setRespectStoragePage(true);
        $defaultQuerySettings->setStoragePageIds([$this->getRecipientListPage()]);
        $addressRepository->setDefaultQuerySettings($defaultQuerySettings);
        return $addressRepository;
    }
}
