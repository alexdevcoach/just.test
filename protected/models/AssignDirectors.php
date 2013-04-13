<?php

/**
 * This is the model class for table "assign_directors".
 *
 * The followings are the available columns in table 'assign_directors':
 * @property integer $manager_id
 * @property integer $director_id
 *
 * The followings are the available model relations:
 * @property Users $director
 * @property Users $manager
 */
class AssignDirectors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AssignDirectors the static model class
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
		return 'assign_directors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('manager_id, director_id', 'complexValidation'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('manager_id, director_id', 'safe', 'on'=>'search'),
		);
	}

	public function complexValidation() {

		if ($this->manager_id == $this->director_id) {
			$this->addError('director_id', '1Нельзя назначить руководителем самого себя');
		} else {

			if (!$manager = Users::model()->findByAttributes(array('id' => $this->manager_id, 'role_id' => Roles::ROLE_MANAGER))) {
				$this->addError('manager_id', '2Пользователь не является менеджером');
			}

			if (!$director = Users::model()->findByAttributes(array('id' => $this->director_id, 'role_id' => Roles::ROLE_DIRECTOR))) {
				$this->addError('director_id', '3Пользователь не является руководителем');
			}

			if (!$this->hasErrors()) {
				if ($assigned = self::model()->findByAttributes(array('manager_id'=>$this->manager_id, 'director_id'=>$this->director_id))) {
					$this->addError('director_id', '4Этот руководитель уже назначен менеджеру');
				}
			}
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
			'director' => array(self::BELONGS_TO, 'Users', 'director_id'),
			'manager' => array(self::BELONGS_TO, 'Users', 'manager_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'manager_id' => 'Manager',
			'director_id' => 'Director',
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

		$criteria->compare('manager_id',$this->manager_id);
		$criteria->compare('director_id',$this->director_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
