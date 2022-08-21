<?php

namespace HouseLock\Flat\Application;

interface UtilityBillingConfigService
{
    public function add(): bool;

    public function update(): bool;

    public function updateTariff(): bool;

    public function remove(): bool;

}