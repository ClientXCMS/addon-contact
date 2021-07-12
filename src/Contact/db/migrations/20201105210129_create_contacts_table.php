<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateContactsTable extends AbstractMigration
{

    const TABLENAME = "contacts";
    public function change()
    {
        $table = $this->table(self::TABLENAME);
        if ($table->exists()) {
            return;
        }

        $table
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('content', 'text', ['limit' => MysqlAdapter::TEXT_LONG])
            ->addColumn('anonymized_ip', 'text')
            ->addColumn("subject", "string")
            ->addTimestamps()
            ->create();
    }
}
