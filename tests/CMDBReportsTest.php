<?php

/**
 * Copyright (C) 2016-18 Benjamin Heisig
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Benjamin Heisig <https://benjamin.heisig.name/>
 * @copyright Copyright (C) 2016-18 Benjamin Heisig
 * @license http://www.gnu.org/licenses/agpl-3.0 GNU Affero General Public License (AGPL)
 * @link https://github.com/bheisig/i-doit-api-client-php
 */

use bheisig\idoitapi\CMDBReports;

class CMDBReportsRelationTest extends BaseTest {

    /**
     * @var \bheisig\idoitapi\CMDBReports
     */
    protected $reports;

    public function setUp() {
        parent::setUp();

        $this->reports = new CMDBReports($this->api);
    }

    /**
     * @throws \Exception
     */
    public function testListReports() {
        $result = $this->reports->listReports();

        $this->assertInternalType('array', $result);
        $this->assertNotCount(0, $result);
    }

    /**
     * @throws \Exception
     */
    public function testRead() {
        $reports = $this->reports->listReports();

        foreach ($reports as $report) {
            $this->assertArrayHasKey('id', $report);

            $reportID = (int) $report['id'];

            $result = $this->reports->read($reportID);

            $this->assertInternalType('array', $result);
        }
    }

    /**
     * @throws \Exception
     */
    public function testBatchRead() {
        $reports = $this->reports->listReports();
        $reportIDs = [];

        foreach ($reports as $report) {
            $this->assertArrayHasKey('id', $report);

            $reportIDs[] = (int) $report['id'];
        }

        if (count($reportIDs) > 0) {
            $result = $this->reports->batchRead($reportIDs);

            $this->assertInternalType('array', $result);
        }
    }

}
