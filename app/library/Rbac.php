<?php
class Rbac extends Phalcon\Mvc\User\Component
{
	
	/**
	 * Get role detail by role_id 
	 * @param string $role_id 
	 * If role_id empty will get all roles.
	 */
	public function get_role( $role_id = '')
	{
		if (!empty($role_id)) {
			$result = Role::findFirst("id='$role_id'");
		} else {
			$result = Role::find();
		}
		return $result;		
	}
	
}