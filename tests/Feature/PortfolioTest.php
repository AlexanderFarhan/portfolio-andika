<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed initial Profile
        Profile::create([
            'id' => 1,
            'name' => 'Andika Amansyah',
            'tagline' => 'Mahasiswa Teknologi Informasi UBSI',
            'headline' => 'System Analyst & Full-Stack Developer',
            'bio_focus' => 'System Analysis, Problem Solving, Web Development, dan Networking',
            'about_me' => 'Halo! Saya Andika Amansyah...',
            'email' => 'andika.amansyah@gmail.com',
            'phone' => '+62 812-3456-7890',
            'location' => 'Bekasi / Jakarta, Indonesia',
        ]);
    }

    public function test_public_portfolio_is_accessible_without_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Andika Amansyah');
        $response->assertSee('System Analyst & Full-Stack Developer');
    }

    public function test_admin_route_redirects_unauthenticated_guests_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_dashboard_redirects_unauthenticated_guests_to_login(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@andika.dev',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@andika.dev',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_access_dashboard_when_authenticated(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Overview Dashboard');
        $response->assertSee('Kelola Seluruh Section');
    }

    public function test_admin_can_update_about_section_and_it_reflects_on_public_page(): void
    {
        $user = User::factory()->create();

        $updatedData = [
            'about_title' => 'Kisah & Profil Andika Amansyah',
            'about_subtitle' => 'Membangun infrastruktur terintegrasi dengan perangkat lunak handal.',
            'headline' => 'Lead System Architect & Senior Engineer',
            'bio_focus' => 'Arsitektur Sistem & Enterprise Network',
            'about_me' => 'Ini adalah teks deskripsi profil baru hasil update admin.',
            'pillars' => [
                [
                    'title' => 'Pilar Kustom Baru',
                    'icon' => 'bi-cpu-fill',
                    'description' => 'Deskripsi pilar kustom hasil update admin.',
                ]
            ],
        ];

        // 1. Submit update from admin
        $response = $this->actingAs($user)->put('/admin/about', $updatedData);

        $response->assertRedirect(route('admin.about.edit'));
        $response->assertSessionHas('success');

        // 2. Check public page immediately displays new content
        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Kisah & Profil Andika Amansyah');
        $publicResponse->assertSee('Ini adalah teks deskripsi profil baru hasil update admin.');
        $publicResponse->assertSee('Pilar Kustom Baru');
    }
}
