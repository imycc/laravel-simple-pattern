<?php

namespace LaravelSimplePattern\Prototype;

trait PrototypeClone
{
    /**
     * Boot the prototype clone trait for a model.
     *
     * @return void
     */
    public static function bootPrototypeClone()
    {
        static::cloning(function ($model) {
            $model = $model->deepClone($model);
        });
    }

    /**
     * clone the object for prototype pattern.
     *
     * @return object
     */
    public function clone($object) {
        return clone $object;
    }

    /**
     * Deep clone the object with reference for prototype pattern.
     *
     * @return object
     */
    public function deepClone($object)
    {
        return unserialize(serialize($object));
    }

}
