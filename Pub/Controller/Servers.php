<?php

namespace RT\SBIntegration\Pub\Controller;

use XF\Pub\Controller\AbstractController;

class Servers extends AbstractController
{
    public static function getActivityDetails(array $activities)
    {
        return \XF::phrase('rt_sbintegration_viewing_servers');
    }

    public function actionIndex()
    {
        if (!\XF::visitor()->canViewServers()) {
            return $this->noPermission();
        }

        /** @var \XF\Mvc\Entity\Finder $result */
        $result = $this->repository('RT\SBIntegration:Data')->findServers()->limit(25);

        $page = $this->filterPage();
        $perPage = 10;

        $total = $result->total();
        $this->assertValidPage($page, $perPage, $total, 'sbservers');
        $result = $result->limitByPage($page, $perPage)->fetch();

        $viewParams = [
            'result' => $result,
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total
        ];

        return $this->view('RT\SBIntegration:Servers', 'rt_sbintegration_servers', $viewParams);
    }
}