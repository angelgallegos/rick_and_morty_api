<?php
declare(strict_types=1);
namespace App\Tests\Unit\Service\Cast;

use App\Client\RickAndMorty\Model\External\Cast\Character;
use App\Client\RickAndMorty\Request\Cast\CharacterRequest;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Service\Cast\CharacterService;
use PHPUnit\Framework\TestCase;

class CharacterServiceTest extends TestCase
{
    public function testGet()
    {
        $character = new Character();
        $character->setName("Rick");
        $requester = $this->createStub(CharacterRequest::class);
        $requester->method("one")
            ->willReturn($character);
        $service = $this->createStub(CharacterService::class);

        $return = $service->get(1);

        $this->assertEquals(
            "Rick",
            $return->getName()
        );
    }

    public function testRequestThrowsError()
    {
        $character = new Character();
        $character->setName("Rick");
        $requester = $this->createStub(CharacterRequest::class);
        $requester->method("one")
            ->willThrowException(RequestException::occurred([]));
        $service = $this->createStub(CharacterService::class);
        $service->method("get")
            ->willReturn($character);

        $return = $service->get(1);

        $this->assertNull($return);
    }
}