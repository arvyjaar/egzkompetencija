<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CriteriaTest extends DuskTestCase
{
    public function testIndex()
    {
        $admin = \App\Models\User::find(1);
        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin);
            $browser->visit(route('admin.criteria.index'));
            $browser->assertRouteIs('admin.criteria.index');
        });
    }
}
