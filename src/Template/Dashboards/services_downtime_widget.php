<div class="padding-10" style="border: 1px solid #c3c3c3;">

    <div class="row">
        <div class="col-lg-1">
            <a href="javascript:void(0);" ng-show="useScroll" ng-click="pauseScroll()"
               title="<?php echo __('Pause scrolling'); ?>"
               class="btn btn-xs btn-primary">
                <i class="fa fa-pause"></i>
            </a>
            <a href="javascript:void(0);" ng-show="!useScroll"
               ng-click="startScroll()" title="<?php echo __('Start scrolling'); ?>"
               class="btn btn-xs btn-primary">
                <i class="fa fa-play"></i>
            </a>
        </div>

        <div class="col-lg-3">
            <div class="form-group form-group-slider">
                <label class="display-inline">
                    <?php echo __('Scroll interval:'); ?>
                    <span class="note" id="PagingInterval_human">
                        {{pagingTimeString}}
                    </span>
                </label>

                <div class="slidecontainer">
                    <input type="range" step="5000" min="5000" max="300000" class="slider" style="width: 100%"
                           ng-model="scroll_interval" ng-model-options="{debounce: 500}">
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row">
                <div class="custom-control custom-checkbox custom-control-left margin-right-10">
                    <input type="checkbox"
                           class="custom-control-input"
                           ng-true-value="1"
                           ng-false-value="0"
                           id="isRunning_{{widget.id}}"
                           ng-model="filter.isRunning"
                           ng-model-options="{debounce: 500}">
                    <label class="custom-control-label" for="isRunning_{{widget.id}}">
                        <?php echo __('Is running'); ?>
                    </label>
                </div>

                <div class="custom-control custom-checkbox custom-control-left margin-right-10">
                    <input type="checkbox"
                           class="custom-control-input"
                           ng-true-value="1"
                           ng-false-value="0"
                           id="notCancelled_{{widget.id}}"
                           ng-model="filter.DowntimeService.was_not_cancelled"
                           ng-model-options="{debounce: 500}">
                    <label class="custom-control-label" for="notCancelled_{{widget.id}}">
                        <?php echo __('Was not cancelled'); ?>
                    </label>
                </div>

                <div class="custom-control custom-checkbox custom-control-left margin-right-10">
                    <input type="checkbox"
                           class="custom-control-input"
                           ng-true-value="1"
                           ng-false-value="0"
                           id="cancelled_{{widget.id}}"
                           ng-model="filter.DowntimeService.was_cancelled"
                           ng-model-options="{debounce: 500}">
                    <label class="custom-control-label" for="cancelled_{{widget.id}}">
                        <?php echo __('Was cancelled'); ?>
                    </label>
                </div>

                <div class="custom-control custom-checkbox custom-control-left margin-right-10">
                    <input type="checkbox"
                           class="custom-control-input"
                           ng-true-value="1"
                           ng-false-value="0"
                           id="hideExpired_{{widget.id}}"
                           ng-model="filter.hideExpired"
                           ng-model-options="{debounce: 500}">
                    <label class="custom-control-label" for="hideExpired_{{widget.id}}">
                        <?php echo __('Hide expired'); ?>
                    </label>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-lg-6 margin-bottom-5">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-prepend fa fa-desktop"></i></span>
                </div>
                <input type="text" class="form-control"
                       placeholder="<?php echo __('Filter by host name'); ?>"
                       ng-model="filter.Host.name"
                       ng-model-options="{debounce: 500}">
            </div>
        </div>
        <div class="col-xs-12 col-lg-6 margin-bottom-5">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-prepend fa fa-cog"></i></span>
                </div>
                <input type="text" class="form-control"
                       placeholder="<?php echo __('Filter by service name'); ?>"
                       ng-model="filter.Service.name"
                       ng-model-options="{debounce: 500}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-lg-6 margin-bottom-5">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-prepend fa fa-filter"></i></span>
                </div>
                <input type="text" class="form-control"
                       placeholder="<?php echo __('Filter by comment'); ?>"
                       ng-model="filter.DowntimeService.comment_data"
                       ng-model-options="{debounce: 500}">
            </div>
        </div>
    </div>
</div>


<div class=" margin-top-10">
    <table id="hostdowntimes_list" class="table table-striped m-0 table-bordered table-hover table-sm">
        <thead>
        <tr>
            <th class="no-sort"><?php echo __('Running'); ?></th>
            <th class="no-sort" ng-click="orderBy('Host.name')">
                <i class="fa" ng-class="getSortClass('Host.name')"></i>
                <?php echo __('Host'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('Service.name')">
                <i class="fa" ng-class="getSortClass('Service.name')"></i>
                <?php echo __('Service'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('DowntimeHost.author_name')">
                <i class="fa" ng-class="getSortClass('DowntimeHost.author_name')"></i>
                <?php echo __('User'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('DowntimeHost.comment_data')">
                <i class="fa" ng-class="getSortClass('DowntimeHost.comment_data')"></i>
                <?php echo __('Comment'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('DowntimeHost.entry_time')">
                <i class="fa" ng-class="getSortClass('DowntimeHost.entry_time')"></i>
                <?php echo __('Created'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('DowntimeHost.scheduled_start_time')">
                <i class="fa" ng-class="getSortClass('DowntimeHost.scheduled_start_time')"></i>
                <?php echo __('Start'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('DowntimeHost.scheduled_end_time')">
                <i class="fa" ng-class="getSortClass('DowntimeHost.scheduled_end_time')"></i>
                <?php echo __('End'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('DowntimeHost.duration')">
                <i class="fa" ng-class="getSortClass('DowntimeHost.duration')"></i>
                <?php echo __('Duration'); ?>
            </th>
            <th class="no-sort" ng-click="orderBy('DowntimeHost.was_cancelled')">
                <i class="fa" ng-class="getSortClass('DowntimeHost.was_cancelled')"></i>
                <?php echo __('Was cancelled'); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="downtime in downtimes">
            <td class="text-center">
                <downtimeicon downtime="downtime.DowntimeService"></downtimeicon>
            </td>
            <td>
                <?php if ($this->Acl->hasPermission('browser', 'hosts')): ?>
                    <a ui-sref="HostsBrowser({id: downtime.Host.id})">
                        {{ downtime.Host.hostname }}
                    </a>
                <?php else: ?>
                    {{ downtime.Host.hostname }}
                <?php endif; ?>
            </td>
            <td>
                <?php if ($this->Acl->hasPermission('browser', 'services')): ?>
                    <a ui-sref="ServicesBrowser({id: downtime.Service.id})">
                        {{ downtime.Service.servicename }}
                    </a>
                <?php else: ?>
                    {{ downtime.Service.servicename }}
                <?php endif; ?>
            </td>
            <td>
                {{downtime.DowntimeService.authorName}}
            </td>
            <td>
                {{downtime.DowntimeService.commentData}}
            </td>
            <td>
                {{downtime.DowntimeService.entryTime}}
            </td>
            <td>
                {{downtime.DowntimeService.scheduledStartTime}}
            </td>
            <td>
                {{downtime.DowntimeService.scheduledEndTime}}
            </td>
            <td>
                {{downtime.DowntimeService.durationHuman}}
            </td>
            <td>
                <span ng-if="downtime.DowntimeService.wasCancelled"><?php echo __('Yes'); ?></span>
                <span ng-if="!downtime.DowntimeService.wasCancelled"><?php echo __('No'); ?></span>
            </td>
        </tr>

        <tr>
        </tbody>
    </table>
    <div class="margin-top-10" ng-show="downtimes.length == 0">
        <div class="text-center text-danger italic">
            <?php echo __('No entries match the selection'); ?>
        </div>
    </div>
    <scroll scroll="scroll" click-action="changepage" only-buttons="true" ng-if="scroll"></scroll>
</div>
