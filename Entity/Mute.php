<?php

namespace RT\SBIntegration\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Mute extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'sb_comms';
        $structure->shortName = 'RT\SBIntegration:Mute';
        $structure->primaryKey = 'bid';
        $structure->columns = [
            'bid' => ['type' => self::UINT, 'autoIncrement' => true],
            'authid' => ['type' => self::STR, 'required' => true],
            'name' => ['type' => self::STR, 'required' => true],
            'created' => ['type' => self::UINT, 'required' => true],
            'length' => ['type' => self::UINT, 'required' => true],
            'ends' => ['type' => self::UINT, 'required' => true],
            'reason' => ['type' => self::STR, 'required' => true],
            'type' => ['type' => self::UINT, 'required' => true],
            'aid' => ['type' => self::UINT, 'required' => true],
            'sid' => ['type' => self::UINT, 'required' => true]
        ];
        $structure->getters = ['ModName' => true];
        $structure->relations = [
            'Administrator' => [
                'entity' => 'RT\SBIntegration:Admin',
                'type' => self::TO_ONE,
                'conditions' => 'aid'
            ],
            'Server' => [
                'entity' => 'RT\SBIntegration:Server',
                'type' => self::TO_ONE,
                'conditions' => 'sid'
            ],
            'Mod' => [
                'entity' => 'RT\SBIntegration:Mod',
                'type' => self::TO_ONE,
                'conditions' => [['mid', '=', '$modid']]
            ]
        ];

        return $structure;
    }

    public function getModName()
    {
        if ($this->sid == 0 || !$this->Server || !$this->Server->Mod)
        {
            return \XF::phrase('rt_sbintegration_web');
        }

        return $this->Server->Mod->name;
    }

}
