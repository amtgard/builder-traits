<?php

namespace Amtgard\Traits\Builder;

use ReflectionClass;

trait ToBuilder {
    public function toBuilder() {
        $className = static::class;
        $source = new ReflectionClass($this);
        $traits = $source->getTraitNames();

        $builderTrait = array_search(__NAMESPACE__ . "\\Builder", $traits);
        if ($builderTrait !== false) {
            $builder = call_user_func(array($className, 'builder'));
            foreach ($source->getProperties() as $sourceProperty) {
                $value = $sourceProperty->getValue($this);
                $builder->{$sourceProperty->getName()}($value);
            }
            return $builder;
        } else {
            throw new \Exception("$className does not include the Builder trait.");
        }
    }
}