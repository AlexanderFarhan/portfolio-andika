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

    public function test_admin_can_upload_avatar_and_resume_pdf_without_server_error(): void
    {
        $user = User::factory()->create();

        // 1x1 transparent PNG bytes
        $pngBytes = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
        $avatarFile = \Illuminate\Http\UploadedFile::fake()->createWithContent('avatar-custom.png', $pngBytes);
        $resumeFile = \Illuminate\Http\UploadedFile::fake()->create('cv-custom.pdf', 150, 'application/pdf');

        $response = $this->actingAs($user)->put('/admin/profile', [
            'name' => 'Andika Amansyah Updated',
            'tagline' => 'Tagline Baru Mahasiswa UBSI',
            'headline' => 'System Analyst Expert',
            'bio_focus' => 'Full-Stack Web & Networking',
            'about_me' => 'Deskripsi profil yang baru diunggah...',
            'email' => 'andika.updated@example.com',
            'phone' => '+62 812-9999-8888',
            'location' => 'Jakarta, Indonesia',
            'years_of_experience' => '3+ Tahun',
            'completed_projects' => 20,
            'gpa' => '3.90 / 4.00',
            'avatar_file' => $avatarFile,
            'resume_file' => $resumeFile,
        ]);

        $response->assertRedirect(route('admin.profile.edit'));
        $response->assertSessionHas('success');

        $profile = Profile::first();
        $this->assertNotNull($profile->avatar);
        $this->assertNotNull($profile->resume_pdf);
        $this->assertStringStartsWith('/storage/profile/', $profile->avatar);
        $this->assertStringStartsWith('/storage/resumes/', $profile->resume_pdf);

        // Verify media files were saved to MediaFile database table
        $avatarDiskPath = str_replace('/storage/', '', $profile->avatar);
        $resumeDiskPath = str_replace('/storage/', '', $profile->resume_pdf);

        $this->assertDatabaseHas('media_files', ['disk_path' => $avatarDiskPath]);
        $this->assertDatabaseHas('media_files', ['disk_path' => $resumeDiskPath]);

        // Verify dynamic media route serves the uploaded avatar
        $avatarResponse = $this->get($profile->avatar);
        $avatarResponse->assertStatus(200);

        // Verify dynamic media route serves the uploaded resume PDF
        $resumeResponse = $this->get($profile->resume_pdf);
        $resumeResponse->assertStatus(200);
        $this->assertEquals('application/pdf', $resumeResponse->headers->get('Content-Type'));

        // Verify public /cv route serves the uploaded PDF directly
        $cvRouteResponse = $this->get('/cv');
        $cvRouteResponse->assertStatus(200);
        $this->assertEquals('application/pdf', $cvRouteResponse->headers->get('Content-Type'));
    }
}
