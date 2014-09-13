<?php

namespace Dizda\CloudBackupBundle\Tests\Databases;

use Dizda\CloudBackupBundle\Tests\AbstractTesting;

/**
 * Class MongoDBTest
 *
 * @package Dizda\CloudBackupBundle\Tests\Databases
 */
class MongoDBTest extends AbstractTesting
{
    /**
     * Test different commands
     */
    public function testGetCommand()
    {
        $mongodb = self::$kernel->getContainer()->get('dizda.cloudbackup.database.mongodb');

        // dump all dbs
        $mongodb->__construct(true, 'localhost', 27017, 'dizbdd', null, null, '/var/backup/');
        $this->assertEquals($mongodb->getCommand(), 'mongodump -h localhost --port 27017  --out /var/backup/mongo/');

        // dump one db with not auth
        $mongodb->__construct(false, 'localhost', 27017, 'dizbdd', null, null, '/var/backup/');
        $this->assertEquals($mongodb->getCommand(), 'mongodump -h localhost --port 27017 --db dizbdd --out /var/backup/mongo/');

        // dump one db with auth
        $mongodb->__construct(false, 'localhost', 27017, 'dizbdd', 'dizda', 'imRootBro', '/var/backup/');
        $this->assertEquals($mongodb->getCommand(), 'mongodump -h localhost --port 27017 -u dizda -p imRootBro --db dizbdd --out /var/backup/mongo/');
    }

}
