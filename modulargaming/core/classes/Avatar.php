<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Abstract avatar class.
 *
 * @package    Modular Gaming
 * @category   Avatar
 * @author     Modular Gaming Team
 * @copyright  (c) 2012-2013 Modular Gaming Team
 * @license    BSD http://modulargaming.com/license
 */
abstract class Avatar {

	/**
	 * @var Model_User $user
	 */
	protected $user;

	/**
	 * @var array $data
	 */
	protected $data;

	/**
	 * Create the correct avatar class depending on the driver.
	 * If a driver isn't found or the driver info is missing, default to Default.
	 *
	 * @param Model_User $user
	 * @param array      $data
	 *
	 * @return Avatar
	 */
	public static function factory(Model_User $user, array $data)
	{
		$driver = Arr::get($data, 'driver', 'Default');

		$class = NULL;

		// Attempt to create the avatar instance.
		try
		{
			$refl = new ReflectionClass('Avatar_'.$driver);
			$class = $refl->newInstance($user, $data);
		}
		catch (ReflectionException $ex)
		{
			$class = new Avatar_Default($user, array());
		}

		return $class;
	}

	/**
	 * @param Model_User $user the avatars user object
	 * @param array      $data extra data
	 */
	public function __construct(Model_User $user, array $data)
	{
		$this->user = $user;
		$this->data = $data;
	}


	/**
	 * Return the url for the avatar.
	 *
	 * @return string
	 */
	abstract public function url();

	/**
	 * @return int height
	 */
	public function height()
	{
		return 64;
	}

	/**
	 * @return int width
	 */
	public function width()
	{
		return 64;
	}
}
