<?php

class m130410_193011_create_tables extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

		$tableName = 'roles';
		$this->createTable($tableName, array(
			'id' => 'pk',
			'name' => 'string',
		));

		$this->insert($tableName, array('name' => 'Администратор'));
		$this->insert($tableName, array('name' => 'Руководитель'));
		$this->insert($tableName, array('name' => 'Менеджер'));

		$tableName = 'users';
		$this->createTable($tableName, array(
			'id' => 'pk',
			'username' => 'string',
			'password' => 'string',
			'fullname' => 'string',
			'role_id' => 'int',
		));

		$this->addForeignKey("fk_{$tableName}_role", $tableName, 'role_id', 'roles', 'id', 'CASCADE', 'CASCADE');

		$this->insert($tableName, array('username' => 'Ivanov', 'fullname' => 'Иванов Иван', 'role_id' => 1));
		$this->insert($tableName, array('username' => 'Petrov', 'fullname' => 'Петров Петр', 'role_id' => 2));
		$this->insert($tableName, array('username' => 'Sidorov', 'fullname' => 'Сидоров Сидор', 'role_id' => 2));
		$this->insert($tableName, array('username' => 'Fedorov', 'fullname' => 'Федоров Федор', 'role_id' => 2));
		$this->insert($tableName, array('username' => 'Mihailov', 'fullname' => 'Михайлов Михаил', 'role_id' => 2));
		$this->insert($tableName, array('username' => 'Nikolaev', 'fullname' => 'Николаев Николай', 'role_id' => 3));
		$this->insert($tableName, array('username' => 'Alekseev', 'fullname' => 'Алексеев Алексей', 'role_id' => 3));
		$this->insert($tableName, array('username' => 'Sergeev', 'fullname' => 'Сергеев Сергей', 'role_id' => 3));
		$this->insert($tableName, array('username' => 'Andreev', 'fullname' => 'Андреев Андрей', 'role_id' => 3));


	}

	public function safeDown()
	{

		$tableName = 'users';
		$this->dropTable($tableName);

		$tableName = 'roles';
		$this->dropTable($tableName);

	}

}
