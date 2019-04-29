<?php

namespace sevtoolboxuk\styx;

use devtoolboxuk\styx\Styx;
use PHPUnit\Framework\TestCase;

class AntiFlood extends TestCase
{

    protected $antiFloodService;

    function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->antiFloodService = new Styx();
    }

    public function testAntiFloodNameSpace()
    {
        $this->assertEquals('antiflood._default', $this->antiFloodService->getAntiFloodNameSpace());
        $this->antiFloodService->setAntiFloodNameSpace('test');
        $this->assertNotEquals('antiflood._default', $this->antiFloodService->getAntiFloodNameSpace());
        $this->assertEquals('antiflood.test', $this->antiFloodService->getAntiFloodNameSpace());

        $this->antiFloodService->setAntiFloodNameSpace('test1');
        $this->assertNotEquals('antiflood.test', $this->antiFloodService->getAntiFloodNameSpace());
        $this->assertEquals('antiflood.test1', $this->antiFloodService->getAntiFloodNameSpace());

    }

    public function testAntiFloodDelay()
    {

        $this->antiFloodService->setAntiFloodNameSpace('unittest');
        $this->assertEquals(60, $this->antiFloodService->getAntiFloodDelay());
        $this->antiFloodService->setAntiFloodDelay(3);
        $this->assertEquals(3, $this->antiFloodService->getAntiFloodDelay());

    }

    public function testAntiFlood()
    {
        $this->antiFloodService->setAntiFloodNameSpace('unittest');
        $this->antiFloodService->setAntiFloodDelay(3);
        $this->assertFalse($this->antiFloodService->detectAntiFlood());

        sleep(2);
        $this->assertTrue($this->antiFloodService->detectAntiFlood());


        sleep(3);
        $this->assertFalse($this->antiFloodService->detectAntiFlood());
    }

}
