<?php

namespace RT\SBIntegration\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Admin extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'sb_admins';
        $structure->shortName = 'RT\SBIntegration:Admin';
        $structure->primaryKey = 'aid';
        $structure->columns = [
            'aid' => ['type' => self::UINT, 'autoIncrement' => true],
            'user' => ['type' => self::STR, 'required' => true]
        ];

        return $structure;
    }
}