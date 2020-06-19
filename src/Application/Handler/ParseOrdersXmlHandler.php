<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Command\ParseOrdersXml;
use Symfony\Component\Serializer\SerializerInterface;
use App\Model\Person;

/**
 *
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
final class ParseOrdersXmlHandler
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    public function __invoke(ParseOrdersXml $command)
    {
        $person = $this->serializer->deserialize($command->getContent(), Person::class, 'xml');

        return $this->serializer->serialize($person, 'json');
    }
}
