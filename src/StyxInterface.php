<?php

namespace devtoolboxuk\styx;

interface StyxInterface
{
    public function detectAntiFlood();

    public function getAntiFloodTime();

    public function getAntiFloodDelay();

    public function getAntiFloodNameSpace();

    public function getStorage();

}