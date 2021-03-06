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

use Predis\Client;
use PSX\V8\ObjectInterface;

/**
 * Redis
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class Redis implements ObjectInterface
{
    /**
     * @var \Predis\Client
     */
    protected $connection;

    /**
     * @param \Predis\Client
     */
    public function __construct(Client $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $key
     * @return string
     */
    public function get($key)
    {
        return $this->connection->get($key);
    }

    /**
     * @param string $key
     * @return int
     */
    public function exists($key)
    {
        return $this->connection->exists($key);
    }

    /**
     * @param string $key
     * @param string $value
     * @param null $expiration
     */
    public function set($key, $value, $expiration = null)
    {
        if (is_int($expiration)) {
            $this->connection->setex($key, $expiration, $value);
        } else {
            $this->connection->set($key, $value);
        }
    }

    /**
     * @param string $key
     * @return int
     */
    public function del($key)
    {
        if (is_array($key)) {
            return $this->connection->del($key);
        } else {
            return $this->connection->del([$key]);
        }
    }

    public function getProperties()
    {
        return [
            'get' => [$this, 'get'],
            'exists' => [$this, 'exists'],
            'set' => [$this, 'set'],
            'del' => [$this, 'del'],
        ];
    }
}
