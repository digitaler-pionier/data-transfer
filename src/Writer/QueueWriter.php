<?php

namespace Tob\DataTransfer\Writer;

use Aws\Sqs\SqsClient;
use Simplicity\ChangeProtocol\Provider\IdentityFinderTrait;
use Simplicity\ChangeProtocol\Provider\v2\ChangeMessageProvider;
use Zend\EventManager\EventManagerAwareTrait;

/**
 * Class QueueWriter
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Writer
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class QueueWriter implements WriterInterface
{
    use EventManagerAwareTrait;
    use IdentityFinderTrait;

    /** @var ChangeMessageProvider */
    protected $changeMessageProvider;
    /** @var SqsClient */
    protected $sqsClient;

    /**
     * QueueWriter constructor.
     *
     * @param ChangeMessageProvider $changeMessageProvider
     * @param SqsClient             $sqsClient
     */
    public function __construct(ChangeMessageProvider $changeMessageProvider, SqsClient $sqsClient)
    {
        $this->changeMessageProvider = $changeMessageProvider;
        $this->sqsClient = $sqsClient;
    }

    /**
     * @param string $resource
     * @param array  $messages
     *
     * @return void
     */
    public function write(string $resource, array $messages)
    {
        $messageResults = [];

        foreach ($messages as $message) {
            $id = $this->findIdentifierValue($message);

            $changeMessage = $this->changeMessageProvider->createChangeMessage($id, $message);

            $arguments = [
                'MessageBody' => json_encode($changeMessage),
                'QueueUrl'    => $resource,
            ];

            $messageResult = $this->sqsClient->sendMessage($arguments)->toArray();
            $messageResults[] = $messageResult;

            $this->getEventManager()->trigger('send', $this, $messageResult);
        }

        $this->getEventManager()->trigger('finish', $this, $messageResults);
    }
}