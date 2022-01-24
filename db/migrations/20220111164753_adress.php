<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Adress extends AbstractMigration
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
        $this->table('adress')
        ->addColumn('civilite', 'enum', ['values' => ['Monsieur', 'Madame']])
        ->addColumn('nom', 'string', ['limit' => 255])
        ->addColumn('prenom', 'string', ['limit' => 255])
        ->addColumn('adresse', 'string', ['limit' => 255])
        ->addColumn('cp', 'string', ['limit' => 255])
        ->addColumn('ville', 'string', ['limit' => 255])
        ->addColumn('pays', 'string', ['limit' => 255])
        ->addColumn('tel', 'string', ['limit' => 255])
        ->addColumn('email', 'string', ['limit' => 255])
        ->addColumn('foreign_id', 'integer', ['user_id' => 'id'])
        ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
        ->create();
        Schema::table('priorities', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    

    /**
     * Migrate Down.
     */
    public function down(): void
    {
        $this->dropTable('adress');
    }
}
