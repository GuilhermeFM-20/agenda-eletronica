<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TableType extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->execute('DROP TABLE IF EXISTS types;');

        $products = $this->table('types');
        $products->addColumn('name','text')
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->addColumn('status','datetime',['null'=>true])
        ->create(); 

    }
}
