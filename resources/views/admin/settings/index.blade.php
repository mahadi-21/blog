<x-admin-layout>
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white relative">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">Site Settings</h1>
            <p class="mt-4 text-xl text-indigo-100">Configure your blog settings and preferences</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        @endif
        
        @if(session('error'))
            <div
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex justify-between items-center">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Cache Clear Button -->
        <div class="mb-6 flex justify-end">
            <form action="{{ route('admin.settings.clear-cache') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition flex items-center"
                    onclick="return confirm('Clear all cache?')">
                    <i class="fa-solid fa-broom mr-2"></i>
                    Clear Cache
                </button>
            </form>
        </div>

        @if ($settings)
            <div class="bg-white rounded-lg shadow" x-data="{ tab: 'general' }">
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200">
                    <nav class="flex flex-wrap -mb-px">
                        <button @click="tab = 'general'"
                            :class="{ 'border-indigo-500 text-indigo-600': tab === 'general', 'border-transparent text-gray-500 hover:text-gray-700': tab !== 'general' }"
                            class="px-6 py-3 text-sm font-medium border-b-2 transition">
                            <i class="fa-solid fa-globe mr-2"></i>General
                        </button>
                        <button @click="tab = 'appearance'"
                            :class="{ 'border-indigo-500 text-indigo-600': tab === 'appearance', 'border-transparent text-gray-500 hover:text-gray-700': tab !== 'appearance' }"
                            class="px-6 py-3 text-sm font-medium border-b-2 transition">
                            <i class="fa-solid fa-paint-brush mr-2"></i>Appearance
                        </button>
                       
                        <button @click="tab = 'social'"
                            :class="{ 'border-indigo-500 text-indigo-600': tab === 'social', 'border-transparent text-gray-500 hover:text-gray-700': tab !== 'social' }"
                            class="px-6 py-3 text-sm font-medium border-b-2 transition">
                            <i class="fa-solid fa-share-nodes mr-2"></i>Social Media
                        </button>
                        <button @click="tab = 'email'"
                            :class="{ 'border-indigo-500 text-indigo-600': tab === 'email', 'border-transparent text-gray-500 hover:text-gray-700': tab !== 'email' }"
                            class="px-6 py-3 text-sm font-medium border-b-2 transition">
                            <i class="fa-solid fa-envelope mr-2"></i>Email
                        </button>
                    </nav>
                </div>

                <!-- Settings Form -->
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf

                    <!-- General Settings Tab -->
                    <div x-show="tab === 'general'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">General Settings</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Name *</label>
                                <input type="text" name="site_name" value="{{ $settings['general']['site_name'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @error('site_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Email *</label>
                                <input type="email" name="site_email" value="{{ $settings['general']['site_email'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @error('site_email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Phone</label>
                                <input type="text" name="site_phone" value="{{ $settings['general']['site_phone'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Description</label>
                                <textarea name="site_description" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $settings['general']['site_description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Appearance Tab -->
                    <div x-show="tab === 'appearance'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Appearance Settings</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Logo</label>
                                @if(!empty($settings['appearance']['site_logo']))
                                    <div class="mb-2 p-2 border rounded-lg bg-gray-50">
                                        <img src="{{ asset($settings['appearance']['site_logo']) }}" alt="Logo"
                                            class="h-16 object-contain">
                                        <p class="text-xs text-gray-500 mt-1">Current logo</p>
                                    </div>
                                @endif
                                <input type="file" name="site_logo" accept="image/*"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <p class="text-xs text-gray-500 mt-1">Recommended size: 200x50px. Max: 2MB</p>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Favicon</label>
                                @if(!empty($settings['appearance']['site_favicon']))
                                    <div class="mb-2 p-2 border rounded-lg bg-gray-50 flex items-center">
                                        <img src="{{ asset($settings['appearance']['site_favicon']) }}" alt="Favicon"
                                            class="h-8 w-8 object-contain">
                                        <p class="text-xs text-gray-500 ml-2">Current favicon</p>
                                    </div>
                                @endif
                                <input type="file" name="site_favicon" accept=".ico,.png"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <p class="text-xs text-gray-500 mt-1">Recommended: 32x32px, ICO/PNG. Max: 1MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Tab -->
                    <div x-show="tab === 'social'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Social Media Links</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook URL
                                </label>
                                <input type="url" name="facebook_url" value="{{ $settings['social']['facebook_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://facebook.com/yourpage">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-twitter text-blue-400 mr-1"></i> Twitter URL
                                </label>
                                <input type="url" name="twitter_url" value="{{ $settings['social']['twitter_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://twitter.com/yourhandle">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-instagram text-pink-600 mr-1"></i> Instagram URL
                                </label>
                                <input type="url" name="instagram_url" value="{{ $settings['social']['instagram_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://instagram.com/yourhandle">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-linkedin text-blue-700 mr-1"></i> LinkedIn URL
                                </label>
                                <input type="url" name="linkedin_url" value="{{ $settings['social']['linkedin_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://linkedin.com/in/yourprofile">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-youtube text-red-600 mr-1"></i> YouTube URL
                                </label>
                                <input type="url" name="youtube_url" value="{{ $settings['social']['youtube_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://youtube.com/@yourchannel">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-github text-gray-800 mr-1"></i> GitHub URL
                                </label>
                                <input type="url" name="github_url" value="{{ $settings['social']['github_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://github.com/yourusername">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-pinterest text-red-700 mr-1"></i> Pinterest URL
                                </label>
                                <input type="url" name="pinterest_url" value="{{ $settings['social']['pinterest_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://pinterest.com/yourhandle">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-tiktok text-black mr-1"></i> TikTok URL
                                </label>
                                <input type="url" name="tiktok_url" value="{{ $settings['social']['tiktok_url'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://tiktok.com/@yourhandle">
                            </div>
                        </div>
                    </div>

                    <!-- Email Tab -->
                    <div x-show="tab === 'email'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Email Configuration</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Driver</label>
                                <select name="mail_driver"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="smtp" {{ ($settings['email']['mail_driver'] ?? '') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                    <option value="mailgun" {{ ($settings['email']['mail_driver'] ?? '') == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                    <option value="ses" {{ ($settings['email']['mail_driver'] ?? '') == 'ses' ? 'selected' : '' }}>SES</option>
                                    <option value="sendmail" {{ ($settings['email']['mail_driver'] ?? '') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Host</label>
                                <input type="text" name="mail_host" value="{{ $settings['email']['mail_host'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="smtp.mailtrap.io">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Port</label>
                                <input type="number" name="mail_port" value="{{ $settings['email']['mail_port'] ?? 587 }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="587">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Username</label>
                                <input type="text" name="mail_username" value="{{ $settings['email']['mail_username'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Password</label>
                                <input type="password" name="mail_password" value="{{ $settings['email']['mail_password'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Encryption</label>
                                <select name="mail_encryption"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="tls" {{ ($settings['email']['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ ($settings['email']['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="" {{ ($settings['email']['mail_encryption'] ?? '') == '' ? 'selected' : '' }}>None</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">From Address</label>
                                <input type="email" name="mail_from_address" value="{{ $settings['email']['mail_from_address'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">From Name</label>
                                <input type="text" name="mail_from_name" value="{{ $settings['email']['mail_from_name'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            {{-- <div class="md:col-span-2">
                                <button type="button" onclick="testEmail()"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                                    <i class="fa-solid fa-paper-plane mr-2"></i> Send Test Email
                                </button>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 flex justify-end border-t pt-6">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center">
                            <i class="fa-solid fa-save mr-2"></i>
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <!-- Test Email Script -->
    {{-- <script>
        function testEmail() {
            // Get the button and show loading state
            const button = event.currentTarget;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Sending...';
            button.disabled = true;

            // Get CSRF token
            const token = document.querySelector('input[name="_token"]')?.value;
            
            if (!token) {
                showNotification('CSRF token not found', 'error');
                button.innerHTML = originalText;
                button.disabled = false;
                return;
            }

            // Get email address
            const emailInput = document.querySelector('input[name="site_email"]');
            const email = emailInput ? emailInput.value : null;
            
            if (!email) {
                showNotification('Please enter a site email address first', 'error');
                button.innerHTML = originalText;
                button.disabled = false;
                return;
            }

            // Send test email request
            fetch('{{ route("admin.settings.test-email") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || 'Test email sent successfully!', 'success');
                } else {
                    showNotification(data.message || 'Failed to send test email', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to send test email. Check console for details.', 'error');
            })
            .finally(() => {
                // Restore button after 2 seconds
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                }, 2000);
            });
        }

        // Notification helper function
        function showNotification(message, type = 'success') {
            // Remove any existing notification
            const existingNotification = document.querySelector('.notification-toast');
            if (existingNotification) {
                existingNotification.remove();
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification-toast fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            notification.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fa-solid ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 hover:text-gray-200">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            `;
            
            // Add to body
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }
    </script> --}}

    <style>
        [x-cloak] {
            display: none !important;
        }
        .notification-toast {
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</x-admin-layout>