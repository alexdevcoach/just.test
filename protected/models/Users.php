<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $fullname
 * @property integer $role_id
 *
 * The followings are the available model relations:
 * @property Roles $role
 */
class Users extends CActiveRecord
{

	public $assignDirector;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('username', 'required'),
			array('password', 'required', 'on'=> 'insert'),

			array('role_id', 'numerical', 'integerOnly'=>true),
			array('username, fullname', 'length', 'max'=>255),

			array('password', 'hashPassword'),


			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, fullname, role_id', 'safe', 'on'=>'search'),
		);
	}

	public function hashPassword() {
		if ($this->password) {
			$this->password = md5(Yii::app()->params['salt'].$this->password);
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
			'directors' => array(self::MANY_MANY, 'Users', 'assign_directors(manager_id, director_id)'),
			'managers' => array(self::MANY_MANY, 'Users', 'assign_directors(director_id, manager_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Логин',
			'password' => 'Пароль',
			'fullname' => 'Ф.И.О.',
			'role_id' => 'Роль',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchManagers()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->addCondition('t.role_id='.Roles::ROLE_MANAGER);
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('fullname',$this->fullname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchManagerDirectors()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->addCondition('t.role_id='.Roles::ROLE_DIRECTOR);
		$criteria->with = array('managers'=> array('together'=>true));
		$criteria->addCondition('managers.id='.$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getunAssignedDirectors() {

		$criteria = array(
			'condition' => 'role_id= :directorRole',
			'params' => array(':directorRole' => Roles::ROLE_DIRECTOR),
		);

		if ($assigned = $this->directors) {
			$in = implode(',',array_keys(CHtml::listData($assigned, 'id','id')));
			$criteria['condition'] .= ' AND id NOT IN ('.$in.')';
		}

		return Users::model()->findAll($criteria);
	}

}
