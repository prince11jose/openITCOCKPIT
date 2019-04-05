<?php
// Copyright (C) <2015>  <it-novum GmbH>
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

namespace itnovum\openITCOCKPIT\Filter;


class HostdependenciesFilter extends Filter {

    /**
     * @return array
     */
    public function indexFilter() {
        $filters = [
            'equals' => [
                'Hostdependencies.inherits_parent',
                'Hostdependencies.execution_fail_on_up',
                'Hostdependencies.execution_fail_on_down',
                'Hostdependencies.execution_fail_on_unreachable',
                'Hostdependencies.execution_fail_on_pending',
                'Hostdependencies.execution_none',
                'Hostdependencies.notification_fail_on_up',
                'Hostdependencies.notification_fail_on_down',
                'Hostdependencies.notification_fail_on_unreachable',
                'Hostdependencies.notification_fail_on_pending',
                'Hostdependencies.notification_none'
            ],
            'like'  => [
                'Hosts.name',
                'HostsDependent.name',
                'Hostgroups.name',
                'HostgroupsDependent.name'
            ],
        ];


        return $this->getConditionsByFilters($filters);
    }

}
