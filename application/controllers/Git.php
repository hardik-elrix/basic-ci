<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/26/2017
 * Time: 3:59 PM
 */

class Git extends Zest
{
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
	}
	
	public function index($param="pull")
	{
		system("git fetch ".GIT_REMOTE." ".GIT_BRANCH_DEV);
		system("git merge origin/".GIT_BRANCH_DEV);
	}
	
	public function g_pull()
	{
		system("git pull ".GIT_REMOTE." ".GIT_BRANCH_DEV);
	}
	
	public function g_status()
	{
		system("git status");
		exit;
	}
	
	public function g_reset()
	{
		$o = system("git reset; git checkout .; git clean -fdx;");
		echo $o."<br>";
		$this->index();
	}
	
	public function g_commit_all()
	{
		$o = system('git add -A && git commit -m "Server Push"');
		$this->index();
	}
	
	public function g_push()
	{
		$o = system('git push '.GIT_REMOTE.' '.GIT_BRANCH_DEV);
		echo $o."<br>";
	}
	
	public function custom()
	{
		echo "Welcome to ";
	}
}