<?php

use Database\Seeders\DrivecategoriesTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            BranchesTableSeeder::class,
            DrivecategoriesTableSeeder::class,
            ObservingTypesTableSeeder::class,
            WorktypesTableSeeder::class,
            FormsTableSeeder::class,
            AssessmentTypesTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CompetenciesTableSeeder::class,
            CriteriaTableSeeder::class,
            FormCompetencyPivotTableSeeder::class,
        ]);
    }
}
