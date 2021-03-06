<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015-2018 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fusio\Adapter\V8\Wrapper\Connection;

use Elasticsearch\Client;
use PSX\V8\ObjectInterface;

/**
 * Elasticsearch
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class Elasticsearch implements ObjectInterface
{
    /**
     * @var \Elasticsearch\Client
     */
    protected $connection;

    /**
     * @param \Elasticsearch\Client $connection
     */
    public function __construct(Client $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param array $params
     * @return array
     */
    public function index($params)
    {
        return $this->connection->index($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function get($params)
    {
        return $this->connection->get($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function delete($params)
    {
        return $this->connection->delete($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function count($params)
    {
        return $this->connection->count($params);
    }

    /**
     * @param array $params
     * @return array|boolean
     */
    public function exists($params)
    {
        return $this->connection->exists($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function create($params)
    {
        return $this->connection->create($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function search($params)
    {
        return $this->connection->search($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function update($params)
    {
        return $this->connection->update($params);
    }

    public function getProperties()
    {
        return [
            'index'  => [$this, 'index'],
            'get'  => [$this, 'get'],
            'delete' => [$this, 'delete'],
            'count'  => [$this, 'count'],
            'exists' => [$this, 'exists'],
            'create' => [$this, 'create'],
            'search' => [$this, 'search'],
            'update' => [$this, 'update'],
        ];
    }

    /**
     * Converts all \stdClass to associative arrays
     * 
     * @param array $params
     * @return array
     */
    private function convertToArray($params)
    {
        return (array) json_decode(json_encode($params), true);
    }
}
