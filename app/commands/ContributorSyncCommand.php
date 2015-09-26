<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ContributorSyncCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'contributor:sync';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sync Project contributors from github';

    private $roleName = 'Contributor';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->createContributorRoleIfNeeded();
        $contributors = $this->getContributorsFromGithub();
        $this->assignContributors($contributors);
	}

    public function createContributorRoleIfNeeded()
    {
        if (!Role::where(['name' => $this->roleName])->exists())
        {
            $role = new Role;
            $role->name = $this->roleName;
            $role->save();
        }

        // Change role named `Admin` to `Maintainer`
        if (Role::where(['name' => 'Admin'])->exists())
        {
            $role = Role::where(['name' => 'Admin'])->first();
            $role->name = 'Maintainer';
            $role->save();
        }
    }

    public function getContributorsFromGithub()
    {
        $github_users = App::make('Phphub\Github\GithubRepoDataReader')->getContributorDataWithRepoName('summerblue/phphub');
        return array_pluck($github_users, 'id');
    }

    public function assignContributors($contributor_github_ids)
    {
        $users = User::whereIn('github_id', $contributor_github_ids)->get();
        $role = Role::where(['name' => $this->roleName])->first();
        foreach ($users as $user)
        {
            if ($user->roles()->count() > 0)
            {
                continue;
            }
            $user->roles()->attach($role->id);
        }

    }
}
