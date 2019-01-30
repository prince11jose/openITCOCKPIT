<?php
// Copyright (C) <2018>  <it-novum GmbH>
//
// This file is dual licensed
//
// 1.
//  This program is free software: you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation, version 3 of the License.
//
//  This program is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// 2.
//  If you purchased an openITCOCKPIT Enterprise Edition you can use this file
//  under the terms of the openITCOCKPIT Enterprise Edition license agreement.
//  License agreement and license key will be shipped with the order
//  confirmation.

namespace App\Lib;


class Constants {

    public function __construct() {
        $this->defineCommandConstants();

        $this->defineContainerTypeIds();
    }

    public function defineCommandConstants() {
        $this->define([
            "CHECK_COMMAND"        => 1,
            "HOSTCHECK_COMMAND"    => 2,
            "NOTIFICATION_COMMAND" => 3,
            "EVENTHANDLER_COMMAND" => 4,
        ]);
    }

    public function defineContainerTypeIds() {
        $this->define([
            'CT_GLOBAL'               => 1,
            'CT_TENANT'               => 2,
            'CT_LOCATION'             => 3,
            'CT_DEVICEGROUP'          => 4,
            'CT_NODE'                 => 5,
            'CT_CONTACTGROUP'         => 6,
            'CT_HOSTGROUP'            => 7,
            'CT_SERVICEGROUP'         => 8,
            'CT_SERVICETEMPLATEGROUP' => 9,
        ]);
    }

    /**
     * @param array $constants
     */
    private function define($constants = []) {
        foreach ($constants as $constantName => $constantValue) {
            if (!defined($constantName)) {
                define($constantName, $constantValue);
            }
        }
    }
}

