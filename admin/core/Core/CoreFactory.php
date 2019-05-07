<?php
/**
 * Copyright (C) 2015-2019 Virgil Security Inc.
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *     (1) Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *     (2) Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *     (3) Neither the name of the copyright holder nor the names of its
 *     contributors may be used to endorse or promote products derived from
 *     this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ''AS IS'' AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT,
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
 * STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Lead Maintainer: Virgil Security Inc. <support@virgilsecurity.com>
 */

namespace VirgilSecurityPure\Core;

use VirgilSecurityPure\Background\BaseBackgroundProcess;
use VirgilSecurityPure\Background\EncryptBackgroundProcess;
use VirgilSecurityPure\Background\MigrateBackgroundProcess;
use VirgilSecurityPure\Background\RecoveryBackgroundProcess;
use VirgilSecurityPure\Background\UpdateBackgroundProcess;
use VirgilSecurityPure\Helpers\DBQueryHelper;

/**
 * Class CoreFactory
 * @package VirgilSecurityPure\Core
 */
class CoreFactory
{
    /**
     * @param string $class
     * @return Core
     * @throws \Virgil\CryptoImpl\VirgilCryptoException
     */
    public function buildCore(string $class): Core
    {
        switch ($class) {
            case 'CoreProtocol':
                return new CoreProtocol();
                break;
            case 'VirgilCryptoWrapper':
                return new VirgilCryptoWrapper();
                break;
            case 'passwordHash':
                return new passw0rdHash();
                break;
            case 'PluginValidator':
                return new PluginValidator();
                break;
            case 'DBQuery':
                return new DBQueryHelper();
                break;
            case 'CredentialsManager':
                return new CredentialsManager();
                break;
            case 'FormHandler':
                return new FormHandler();
                break;
            default:
                $this->throwError($class);
        }
    }

    /**
     * @param string $class
     * @return BaseBackgroundProcess
     */
    public function buildBackgroundProcess(string $class): BaseBackgroundProcess
    {
        switch ($class) {
            case 'Migrate':
                return new MigrateBackgroundProcess();
                break;
            case 'Update':
                return new UpdateBackgroundProcess();
                break;
            case 'Encrypt':
                return new EncryptBackgroundProcess();
                break;
            case 'Recovery':
                return new RecoveryBackgroundProcess();
                break;
            default:
                $this->throwError($class);
        }
    }

    /**
     * @param string $class
     */
    private function throwError(string $class)
    {
        var_dump("Invalid class name: $class");
        die;
    }
}