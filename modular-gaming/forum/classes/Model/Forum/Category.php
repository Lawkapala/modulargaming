<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Forum_Category extends ORM {


	protected $_created_column = array(
		'column' => 'created',
		'format' => TRUE,
	);

	protected $_has_many = array(
		'topics' => array(
			'model' => 'Forum_Topic',
			'foreign_key' => 'category_id',
		),
	);

	static public function category_open($id)
	{
		$category = ORM::factory('Forum_Category', $id);
		if (Auth::instance()->get_user()->can('Forum_Topic_Create', array('category' => $category)) OR $category->locked == 0)
		{
			return true;
		}
		return false;
	}

	static public function category_exists($id)
	{
		$category = ORM::factory('Forum_Category', $id);

		return $category->loaded();
	}

	public function rules()
	{
		return array(
			'title' => array(
				array('not_empty'),
				array('max_length', array(':value', 50)),
			),

			'description' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
		);
	}

	public function create_category($values, $expected)
	{
		return $this->values($values, $expected)
			->create();
	}

}