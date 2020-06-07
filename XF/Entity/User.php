<?php


namespace RT\SBIntegration\XF\Entity;


class User extends XFCP_User
{
    public function canViewServers()
    {
        return $this->hasPermission('sbIntegration', 'canViewServers');
    }

    public function canViewLastBans()
    {
        return $this->hasPermission('sbIntegration', 'canViewLastBans');
    }

    public function canViewLastMutes()
    {
        return $this->hasPermission('sbIntegration', 'canViewLastMutes');
    }
}