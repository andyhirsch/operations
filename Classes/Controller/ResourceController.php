<?php

namespace Kanow\Operations\Controller;

use Kanow\Operations\Domain\Model\Resource;
use Kanow\Operations\Domain\Repository\ResourceRepository;
use Psr\Http\Message\ResponseInterface;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Karsten Nowak <captnnowi@gmx.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ResourceController extends BaseController
{
    /**
     * @var ResourceRepository
     */
    protected ResourceRepository $resourceRepository;

    public function __construct(\Kanow\Operations\Domain\Repository\ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

    /**
     * action list
     */
    public function listAction(): ResponseInterface
    {
        $resources = $this->resourceRepository->findAll();
        $this->view->assign('resources', $resources);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param resource $resource
     */
    public function showAction(Resource $resource): ResponseInterface
    {
        $this->view->assign('resource', $resource);
        return $this->htmlResponse();
    }
}
