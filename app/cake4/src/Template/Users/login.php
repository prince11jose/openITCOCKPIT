<?php
// Copyright (C) <2015>  <it-novum GmbH>
//
// This file is dual licensed
//
// 1.
//	This program is free software: you can redistribute it and/or modify
//	it under the terms of the GNU General Public License as published by
//	the Free Software Foundation, version 3 of the License.
//
//	This program is distributed in the hope that it will be useful,
//	but WITHOUT ANY WARRANTY; without even the implied warranty of
//	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//	GNU General Public License for more details.
//
//	You should have received a copy of the GNU General Public License
//	along with this program.  If not, see <http://www.gnu.org/licenses/>.
//

// 2.
//	If you purchased an openITCOCKPIT Enterprise Edition you can use this file
//	under the terms of the openITCOCKPIT Enterprise Edition license agreement.
//	License agreement and license key will be shipped with the order
//	confirmation.

/**
 * @var \App\View\AppView $this
 */
?>

<div id="particles-js" class="peer peer-greed h-100 pos-r">
    <!-- layout fix -->
</div>

<div
    ng-controller="UsersLoginController"
    class="col-12 col-md-4 peer pX-40 pY-80 h-100 scrollable pos-r login-side-bg" style='min-width: 320px;'>

    <div class="col-12">
        <img class="img-fluid" src="/img/logos/openITCOCKPIT_Logo_Big.png"/>
    </div>

    <h4 class="fw-300 c-white mB-40"><?= __('Login') ?></h4>
    <form ng-submit="submit();">
        <div class=" form-group
    ">
    <label class="text-normal c-white"><?= __('Username') ?></label>
    <input
        type="text"
        class="form-control"
        placeholder="John Doe"
        ng-model="post.email">
</div>
<div class="form-group">
    <label class="text-normal c-white"><?= __('Password') ?></label>
    <input
        type="password"
        class="form-control"
        placeholder="Password"
        ng-model="post.password">
</div>
<div class="form-group">
    <div class="peers ai-c jc-sb fxw-nw">
        <div class="peer">
            <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                <input
                    type="checkbox"
                    ng-true-value="1"
                    ng-false-value="0"
                    ng-model="post.remember_me"
                    id="RememberMeCheckbox"
                    class="peer">
                <label for="RememberMeCheckbox" class=" peers peer-greed js-sb ai-c">
                    <span class="peer peer-greed"><?= __('Remember Me') ?></span>
                </label>
            </div>
        </div>
        <div class="peer">
            <input type="submit" class="btn btn-primary" value="<?= __('Login') ?>">
        </div>
    </div>
</div>
</form>

<div class="float-right" style="padding-top: 100px;">
    <a href="https://openitcockpit.io/" target="_blank" class="btn btn-sm btn-light btn-icon">
        <i class="fa fa-lg fa-globe"></i>
    </a>
    <a href="https://github.com/it-novum/openITCOCKPIT" target="_blank"
       class="btn btn-sm btn-light btn-icon">
        <i class="fab fa-lg fa-github"></i>
    </a>
    <a href="https://twitter.com/openITCOCKPIT" target="_blank" class="btn btn-sm btn-light btn-icon">
        <i class="fab fa-lg fa-twitter"></i>
    </a>
    <a href="https://www.reddit.com/r/openitcockpit" target="_blank" class="btn btn-sm btn-light btn-icon">
        <i class="fab fa-lg fa-reddit"></i>
    </a>
</div>

</div>