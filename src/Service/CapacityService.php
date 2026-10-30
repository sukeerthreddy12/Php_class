<?php

namespace App\Service;
use App\Entity\FitnessClass;

class CapacityService
{
    public function hasSpace(FitnessClass $class, int $booked): bool
    {
        return $booked < $class->getCapacity();
    }
}