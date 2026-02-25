<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        
        // Merge with defaults to avoid undefined index errors
        $defaults = [
            'general' => [
                'site_name' => 'My Blog',
                'site_email' => '',
                'site_phone' => '',
                'site_description' => '',
            ],
            'appearance' => [
                'site_logo' => '',
                'site_favicon' => '',
            ],
            'social' => [
                'facebook_url' => '',
                'twitter_url' => '',
                'instagram_url' => '',
                'linkedin_url' => '',
                'youtube_url' => '',
                'github_url' => '',
                'pinterest_url' => '',
                'tiktok_url' => '',
            ],
            'email' => [
                'mail_driver' => 'smtp',
                'mail_host' => '',
                'mail_port' => 587,
                'mail_username' => '',
                'mail_password' => '',
                'mail_encryption' => 'tls',
                'mail_from_address' => '',
                'mail_from_name' => '',
            ],
        ];
        
        // Merge existing settings with defaults
        foreach ($defaults as $key => $defaultValue) {
            if (!isset($settings[$key])) {
                $settings[$key] = $defaultValue;
            }
        }
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            // General Settings
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'site_phone' => 'nullable|string|max:50',
            'site_description' => 'nullable|string',

            // Appearance Settings (Files)
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png|max:1024',

            // Social Media URLs
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'pinterest_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',

            // Email Settings
            'mail_driver' => 'nullable|string|in:smtp,mailgun,ses,sendmail',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|numeric|min:1|max:65535',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|in:tls,ssl,',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        try {
            // Ensure upload directories exist
            $this->ensureDirectoriesExist();
            
            // Handle General Settings
            $generalSettings = [
                'site_name' => $validated['site_name'],
                'site_email' => $validated['site_email'],
                'site_phone' => $validated['site_phone'] ?? '',
                'site_description' => $validated['site_description'] ?? '',
            ];

            // Get existing appearance settings
            $appearanceSetting = Setting::where('key', 'appearance')->first();
            $appearanceSettings = $appearanceSetting ? $appearanceSetting->value : [];

            // Upload Site Logo to public folder
            if ($request->hasFile('site_logo')) {
                // Delete old logo if exists
                if (!empty($appearanceSettings['site_logo'])) {
                    $oldLogoPath = public_path($appearanceSettings['site_logo']);
                    if (file_exists($oldLogoPath)) {
                        unlink($oldLogoPath);
                    }
                }

                $file = $request->file('site_logo');
                $filename = 'logo-' . time() . '.' . $file->getClientOriginalExtension();

                // Save to public/uploads/settings/logo directory
                $file->move(public_path('uploads/settings/logo'), $filename);

                // Store the relative path
                $appearanceSettings['site_logo'] = 'uploads/settings/logo/' . $filename;
            }

            // Upload Favicon to public folder
            if ($request->hasFile('site_favicon')) {
                // Delete old favicon if exists
                if (!empty($appearanceSettings['site_favicon'])) {
                    $oldFaviconPath = public_path($appearanceSettings['site_favicon']);
                    if (file_exists($oldFaviconPath)) {
                        unlink($oldFaviconPath);
                    }
                }

                $file = $request->file('site_favicon');
                $filename = 'favicon-' . time() . '.' . $file->getClientOriginalExtension();

                // Save to public/uploads/settings/favicon directory
                $file->move(public_path('uploads/settings/favicon'), $filename);

                // Store the relative path
                $appearanceSettings['site_favicon'] = 'uploads/settings/favicon/' . $filename;
            }

            // Handle Social Media Settings
            $socialSettings = [
                'facebook_url' => $validated['facebook_url'] ?? '',
                'twitter_url' => $validated['twitter_url'] ?? '',
                'instagram_url' => $validated['instagram_url'] ?? '',
                'linkedin_url' => $validated['linkedin_url'] ?? '',
                'youtube_url' => $validated['youtube_url'] ?? '',
                'github_url' => $validated['github_url'] ?? '',
                'pinterest_url' => $validated['pinterest_url'] ?? '',
                'tiktok_url' => $validated['tiktok_url'] ?? '',
            ];

            // Handle Email Settings
            $emailSettings = [
                'mail_driver' => $validated['mail_driver'] ?? 'smtp',
                'mail_host' => $validated['mail_host'] ?? '',
                'mail_port' => $validated['mail_port'] ?? 587,
                'mail_username' => $validated['mail_username'] ?? '',
                'mail_password' => $validated['mail_password'] ?? '',
                'mail_encryption' => $validated['mail_encryption'] ?? 'tls',
                'mail_from_address' => $validated['mail_from_address'] ?? $validated['site_email'],
                'mail_from_name' => $validated['mail_from_name'] ?? $validated['site_name'],
            ];

            // Save all settings using key-value pairs
            Setting::updateOrCreate(
                ['key' => 'general'],
                ['value' => $generalSettings]
            );
            
            Setting::updateOrCreate(
                ['key' => 'appearance'],
                ['value' => $appearanceSettings]
            );
            
            Setting::updateOrCreate(
                ['key' => 'social'],
                ['value' => $socialSettings]
            );
            
            Setting::updateOrCreate(
                ['key' => 'email'],
                ['value' => $emailSettings]
            );

            // Update .env file for email settings (optional)
            // $this->updateEnvFile($emailSettings);

            // Clear cache if needed
            Cache::forget('site_settings');

            return redirect()->route('admin.settings')
                ->with('success', 'Settings updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update settings: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Ensure upload directories exist
     */
    private function ensureDirectoriesExist()
    {
        $directories = [
            public_path('uploads'),
            public_path('uploads/settings'),
            public_path('uploads/settings/logo'),
            public_path('uploads/settings/favicon'),
        ];
        
        foreach ($directories as $directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
        }
    }

    private function updateEnvFile($emailSettings)
    {
        $envFile = base_path('.env');

        if (file_exists($envFile)) {
            $envContent = file_get_contents($envFile);

            $envVariables = [
                'MAIL_MAILER' => $emailSettings['mail_driver'],
                'MAIL_HOST' => $emailSettings['mail_host'],
                'MAIL_PORT' => $emailSettings['mail_port'],
                'MAIL_USERNAME' => $emailSettings['mail_username'],
                'MAIL_PASSWORD' => $emailSettings['mail_password'],
                'MAIL_ENCRYPTION' => $emailSettings['mail_encryption'],
                'MAIL_FROM_ADDRESS' => $emailSettings['mail_from_address'],
                'MAIL_FROM_NAME' => '"' . $emailSettings['mail_from_name'] . '"',
            ];

            foreach ($envVariables as $key => $value) {
                if (strpos($envContent, $key . '=') !== false) {
                    // Update existing variable
                    $envContent = preg_replace(
                        '/' . $key . '=.*/',
                        $key . '=' . $value,
                        $envContent
                    );
                } else {
                    // Add new variable
                    $envContent .= "\n" . $key . '=' . $value;
                }
            }

            file_put_contents($envFile, $envContent);
        }
    }

    /**
     * Clear application cache
     */
    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return back()->with('success', 'Cache cleared successfully!');
    }

    public function testEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        
        try {
            // Get email settings
            $emailSettings = Setting::where('key', 'email')->first()?->value ?? [];
            
            // Configure mail temporarily
            config([
                'mail.mailers.smtp.host' => $emailSettings['mail_host'] ?? env('MAIL_HOST', 'smtp.mailtrap.io'),
                'mail.mailers.smtp.port' => $emailSettings['mail_port'] ?? env('MAIL_PORT', 587),
                'mail.mailers.smtp.username' => $emailSettings['mail_username'] ?? env('MAIL_USERNAME'),
                'mail.mailers.smtp.password' => $emailSettings['mail_password'] ?? env('MAIL_PASSWORD'),
                'mail.mailers.smtp.encryption' => $emailSettings['mail_encryption'] ?? env('MAIL_ENCRYPTION', 'tls'),
                'mail.from.address' => $emailSettings['mail_from_address'] ?? env('MAIL_FROM_ADDRESS', $request->email),
                'mail.from.name' => $emailSettings['mail_from_name'] ?? env('MAIL_FROM_NAME', 'Blog Settings'),
            ]);
            
            // Send test email
            Mail::raw('This is a test email from your blog settings. If you received this, your email configuration is working correctly!', function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Test Email from Blog Settings');
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully to ' . $request->email . '!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send test email: ' . $e->getMessage()
            ], 500);
        }
    }
}