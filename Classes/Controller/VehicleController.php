<?php

namespace Kanow\Operations\Controller;

use Kanow\Operations\Domain\Model\Vehicle;
use Kanow\Operations\Domain\Repository\VehicleRepository;
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
class VehicleController extends BaseController
{
    /**
     * @var VehicleRepository
     */
    protected VehicleRepository $vehicleRepository;

    public function __construct(\Kanow\Operations\Domain\Repository\VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * action list
     */
    public function listAction(): ResponseInterface
    {
        $vehicles = $this->vehicleRepository->findAll();
        $this->view->assign('vehicles', $vehicles);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param Vehicle $vehicle
     */
    public function showAction(Vehicle $vehicle): ResponseInterface
    {
        $this->view->assign('vehicle', $vehicle);
        return $this->htmlResponse();
    }
}
