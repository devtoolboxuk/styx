<?php

namespace devtoolboxuk\styx;

use devtoolboxuk\styx\Storage\SessionStorage;

class Styx implements StyxInterface
{
    const ANTIFLOOD_NAMESPACE = '_default';
    const ANTIFLOOD_DELAY = 60;

    protected $storage;
    protected $delay;
    protected $namespace;

    public function __construct($namespace = self::ANTIFLOOD_NAMESPACE, $delay = self::ANTIFLOOD_DELAY, StorageInterface $storage = null)
    {
        $this->storage = $storage ? '' : new SessionStorage();
        $this->storage->storeNameSpace($namespace);
        $this->storage->storeDelay($delay);
    }

    /**
     * @param string $namespace
     */
    public function setAntiFloodNameSpace($namespace = self::ANTIFLOOD_NAMESPACE)
    {
        $this->storage->storeNameSpace($namespace);
    }

    /**
     * @param int $delay
     */
    public function setAntiFloodDelay($delay = self::ANTIFLOOD_DELAY)
    {
        $this->storage->storeDelay($delay);
    }

    /**
     * @return mixed
     */
    public function getAntiFloodNameSpace()
    {
        return $this->storage->getNameSpace();
    }

    /**
     * @return bool
     */
    public function detectAntiFlood()
    {
        if (!$this->getAntiFloodTime()) {
            $this->setAntiFloodTime();
        } else {
            if ($this->antiFloodInOperation()) {
                $this->setAntiFloodTime();
                return true;
            } else {
                $this->removeAntiFlood();
            }
        }
        return false;
    }

    private function setAntiFloodTime()
    {
        $this->storage->storeTime();
    }

    private function antiFloodInOperation()
    {
        return $this->timeDifference() < $this->getAntiFloodDelay();
    }

    private function timeDifference()
    {
        return time() - $this->getAntiFloodTime();
    }

    /**
     * @return string|null
     */
    public function getAntiFloodTime()
    {
        return $this->storage->getTime();
    }

    /**
     * @return int|null
     */
    public function getAntiFloodDelay()
    {
        return $this->storage->getDelay();
    }

    /**
     * @return object|null
     */
    public function getStorage()
    {
        return $this->storage->getStorage();
    }

    private function removeAntiFlood()
    {
        $this->storage->clear();
    }
}