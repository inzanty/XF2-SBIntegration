<?php

namespace RT\SBIntegration;

class Listener
{
    public static function templaterSetup(\XF\Container $container, \XF\Template\Templater &$templater)
    {
        $templater->addFunction('rt_sbintegration_sec_to_string', function (\XF\Template\Templater $templater, &$escape, $sec)
        {
            if ($sec == 0)
            {
                return \XF::phrase('never');
            }

            $div = [2592000, 604800, 86400, 3600, 60, 1];
            $desc = [
                \XF::phrase('months'),
                \XF::phrase('weeks'),
                \XF::phrase('units_days'),
                \XF::phrase('units_hours'),
                \XF::phrase('units_minutes'),
                \XF::phrase('units_seconds')
            ];
            $ret = null;
            foreach($div as $index => $value)
            {
                $quotent = floor($sec / $value);
                if($quotent > 0) {
                    $ret .= "$quotent {$desc[$index]}, ";
                    $sec %= $value;
                }
            }
            return substr($ret, 0, -2);
        });
    }
}