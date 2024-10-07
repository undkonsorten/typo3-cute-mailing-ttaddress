<?php

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;
use Undkonsorten\CuteMailingTtAddress\Domain\Model\TtAddressRecipientList;
use Undkonsorten\CuteMailingTtAddress\Domain\Repository\TtAddressRecipientListRepository;

class TtaddressRecipientListTest extends FunctionalTestCase
{

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/cute_mailing',
        'typo3conf/ext/tt_address',
        'typo3conf/ext/cute_mailing_ttaddress',
        'typo3conf/ext/taskqueue'
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/tx_cutemailing_domain_model_recipientlist.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/tt_address.csv');
    }

    /**
     * @return void
     * @test
     */
    public function recipientCanBeDeleted(): void
    {
        /** @var PersistenceManager $persistenceManager */
        $persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
        $recipientListRepository = GeneralUtility::makeInstance(TtAddressRecipientListRepository::class);
        $recipientListRepository->injectPersistenceManager($persistenceManager);
        $defaultQuerySettings = $recipientListRepository->createQuery()->getQuerySettings();
        $defaultQuerySettings->setRespectStoragePage(false);
        $recipientListRepository->setDefaultQuerySettings($defaultQuerySettings);
        /** @var TtAddressRecipientList $recipientList */
        $recipientList = $recipientListRepository->findByUid(1);
        $recipients = $recipientList->getRecipients();
        self::assertEquals(count($recipients),2);
        $recipientList->removeRecipientByEmail('peter.supermann@test.de');
        $persistenceManager->persistAll();
        $recipients = $recipientList->getRecipients();
        self::assertEquals(count($recipients),1);
        $recipientList->removeRecipientById(2);
        $persistenceManager->persistAll();
        $recipients = $recipientList->getRecipients();
        self::assertEquals(count($recipients),0);
    }
}
