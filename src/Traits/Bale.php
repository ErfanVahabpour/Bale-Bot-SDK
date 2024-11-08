<?php

namespace EFive\Bale\Traits;

use EFive\Bale\Api;

/**
 * Class Bale.
 */
trait Bale
{
    /**
     * @var Api|null Bale Api Instance.
     */
    protected ?Api $bale = null;

    /**
     * Get Bale Api Instance.
     */
    public function getbale(): Api
    {
        return $this->bale;
    }

    /**
     * Set Bale Api Instance.
     */
    public function setbale(Api $bale): self
    {
        $this->bale = $bale;

        return $this;
    }
}