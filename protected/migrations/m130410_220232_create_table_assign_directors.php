<?php

class m130410_220232_create_table_assign_directors extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$tableName = 'assign_directors';

		$this->createTable($tableName, array(
			'manager_id' => 'int',
			'director_id' => 'int',
			'PRIMARY KEY(manager_id, director_id)',
		));

		$this->addForeignKey("fk_{$tableName}_managers", $tableName, 'manager_id', 'users', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey("fk_{$tableName}_directors", $tableName, 'director_id', 'users', 'id', 'CASCADE', 'CASCADE');

	}

	public function safeDown()
	{
		$tableName = 'assign_directors';

		$this->dropTable($tableName);
	}

}
