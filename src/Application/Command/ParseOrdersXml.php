<?php

declare(strict_types=1);
namespace App\Application\Command;
use App\Model\Person;

/**
 * @TODO Add description!
 *
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
final class ParseOrdersXml
{
    private $content;

    public function __construct( string $content)
    {

        $this->content = $content;
    }


    public function getContent()
    {
        return $this->content;
    }
}
