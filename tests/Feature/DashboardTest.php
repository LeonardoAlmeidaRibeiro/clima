<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_dashboard_is_served_at_both_entry_points(): void
    {
        foreach (['/', '/painel'] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertViewIs('dashboard')
                ->assertSee('Painel do gestor')
                ->assertSee('Ambiente demonstrativo')
                ->assertSee('id="mapa"', false)
                ->assertSee('id="category-filter"', false)
                ->assertSee('id="acoes"', false)
                ->assertSee('css/dashboard.css')
                ->assertSee('js/dashboard.js')
                ->assertSee('vendor/metronic/css/style.bundle.css')
                ->assertSee('vendor/metronic/plugins/global/plugins.bundle.js')
                ->assertSee('vendor/metronic/js/scripts.bundle.js')
                ->assertSee('data-bs-toggle="dropdown"', false)
                ->assertSee('data-kt-drawer="true"', false);
        }
    }
}
