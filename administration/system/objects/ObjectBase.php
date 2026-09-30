<?php
class ObjectBase
{
    public function initAttributes($fetchAll): void
    {
        if ($fetchAll != null) {
            foreach ($fetchAll as $label => $value) {
                $this->$label = $value;
            }
        }
    }
}