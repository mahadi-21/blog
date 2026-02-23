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
                        <button @click="tab = 'seo'"
                            :class="{ 'border-indigo-500 text-indigo-600': tab === 'seo', 'border-transparent text-gray-500 hover:text-gray-700': tab !== 'seo' }"
                            class="px-6 py-3 text-sm font-medium border-b-2 transition">
                            <i class="fa-solid fa-chart-line mr-2"></i>SEO
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
                        <button @click="tab = 'comments'"
                            :class="{ 'border-indigo-500 text-indigo-600': tab === 'comments', 'border-transparent text-gray-500 hover:text-gray-700': tab !== 'comments' }"
                            class="px-6 py-3 text-sm font-medium border-b-2 transition">
                            <i class="fa-solid fa-comments mr-2"></i>Comments
                        </button>
                        <button @click="tab = 'security'"
                            :class="{ 'border-indigo-500 text-indigo-600': tab === 'security', 'border-transparent text-gray-500 hover:text-gray-700': tab !== 'security' }"
                            class="px-6 py-3 text-sm font-medium border-b-2 transition">
                            <i class="fa-solid fa-shield mr-2"></i>Security
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
                                <input type="text" name="site_name" value="{{ $settings['general']['site_name'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Email *</label>
                                <input type="email" name="site_email" value="{{ $settings['general']['site_email'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Phone</label>
                                <input type="text" name="site_phone" value="{{ $settings['general']['site_phone'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Timezone</label>
                                <select name="site_timezone"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="UTC" {{ $settings['general']['site_timezone'] == 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ $settings['general']['site_timezone'] == 'America/New_York' ? 'selected' : '' }}>
                                        Eastern Time</option>
                                    <option value="America/Chicago" {{ $settings['general']['site_timezone'] == 'America/Chicago' ? 'selected' : '' }}>
                                        Central Time</option>
                                    <option value="America/Denver" {{ $settings['general']['site_timezone'] == 'America/Denver' ? 'selected' : '' }}>
                                        Mountain Time</option>
                                    <option value="America/Los_Angeles" {{ $settings['general']['site_timezone'] == 'America/Los_Angeles' ? 'selected' : '' }}>
                                        Pacific Time</option>
                                    <option value="Europe/London" {{ $settings['general']['site_timezone'] == 'Europe/London' ? 'selected' : '' }}>London</option>
                                    <option value="Europe/Paris" {{ $settings['general']['site_timezone'] == 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                                    <option value="Asia/Tokyo" {{ $settings['general']['site_timezone'] == 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo</option>
                                    <option value="Australia/Sydney" {{ $settings['general']['site_timezone'] == 'Australia/Sydney' ? 'selected' : '' }}>
                                        Sydney</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Description</label>
                                <textarea name="site_description" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $settings['general']['site_description'] }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Address</label>
                                <textarea name="site_address" rows="2"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $settings['general']['site_address'] }}</textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Keywords</label>
                                <input type="text" name="site_keywords" value="{{ $settings['general']['site_keywords'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="blog, articles, news">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Language</label>
                                <select name="site_language"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="en" {{ $settings['general']['site_language'] == 'en' ? 'selected' : '' }}>
                                        English</option>
                                    <option value="es" {{ $settings['general']['site_language'] == 'es' ? 'selected' : '' }}>
                                        Spanish</option>
                                    <option value="fr" {{ $settings['general']['site_language'] == 'fr' ? 'selected' : '' }}>
                                        French</option>
                                    <option value="de" {{ $settings['general']['site_language'] == 'de' ? 'selected' : '' }}>
                                        German</option>
                                    <option value="it" {{ $settings['general']['site_language'] == 'it' ? 'selected' : '' }}>
                                        Italian</option>
                                    <option value="pt" {{ $settings['general']['site_language'] == 'pt' ? 'selected' : '' }}>
                                        Portuguese</option>
                                    <option value="ru" {{ $settings['general']['site_language'] == 'ru' ? 'selected' : '' }}>
                                        Russian</option>
                                    <option value="zh" {{ $settings['general']['site_language'] == 'zh' ? 'selected' : '' }}>
                                        Chinese</option>
                                    <option value="ja" {{ $settings['general']['site_language'] == 'ja' ? 'selected' : '' }}>
                                        Japanese</option>
                                    <option value="ar" {{ $settings['general']['site_language'] == 'ar' ? 'selected' : '' }}>
                                        Arabic</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Appearance Tab -->
                    <div x-show="tab === 'appearance'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Appearance Settings</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Site Logo</label>
                                @if($settings['appearance']['site_logo'])
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings['appearance']['site_logo']) }}" alt="Logo"
                                            class="h-16">
                                    </div>
                                @endif
                                <input type="file" name="site_logo" accept="image/*"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Favicon</label>
                                @if($settings['appearance']['site_favicon'])
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings['appearance']['site_favicon']) }}" alt="Favicon"
                                            class="h-8">
                                    </div>
                                @endif
                                <input type="file" name="site_favicon" accept="image/*"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Primary Color</label>
                                <input type="color" name="primary_color"
                                    value="{{ $settings['appearance']['primary_color'] }}"
                                    class="w-full h-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Secondary Color</label>
                                <input type="color" name="secondary_color"
                                    value="{{ $settings['appearance']['secondary_color'] }}"
                                    class="w-full h-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Posts Per Page</label>
                                <input type="number" name="posts_per_page"
                                    value="{{ $settings['appearance']['posts_per_page'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    min="1" max="100">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Header Layout</label>
                                <select name="header_layout"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="default" {{ $settings['appearance']['header_layout'] == 'default' ? 'selected' : '' }}>Default</option>
                                    <option value="centered" {{ $settings['appearance']['header_layout'] == 'centered' ? 'selected' : '' }}>Centered</option>
                                    <option value="minimal" {{ $settings['appearance']['header_layout'] == 'minimal' ? 'selected' : '' }}>Minimal</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <h4 class="text-md font-medium text-gray-900 mb-2">Post Display Options</h4>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="show_author" value="1" {{ $settings['appearance']['show_author'] ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600">
                                        <span class="text-gray-700 text-sm">Show Author Name</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="show_date" value="1" {{ $settings['appearance']['show_date'] ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600">
                                        <span class="text-gray-700 text-sm">Show Publish Date</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="show_views" value="1" {{ $settings['appearance']['show_views'] ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600">
                                        <span class="text-gray-700 text-sm">Show View Count</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="show_shares" value="1" {{ $settings['appearance']['show_shares'] ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600">
                                        <span class="text-gray-700 text-sm">Show Share Buttons</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Tab -->
                    <div x-show="tab === 'seo'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ $settings['seo']['meta_title'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Meta Description</label>
                                <textarea name="meta_description" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $settings['seo']['meta_description'] }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Recommended: 150-160 characters</p>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Meta Keywords</label>
                                <input type="text" name="meta_keywords" value="{{ $settings['seo']['meta_keywords'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="blog, articles, writing">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Google Analytics ID</label>
                                <input type="text" name="google_analytics_id"
                                    value="{{ $settings['seo']['google_analytics_id'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="UA-XXXXXXXXX-X">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Facebook Pixel ID</label>
                                <input type="text" name="facebook_pixel_id"
                                    value="{{ $settings['seo']['facebook_pixel_id'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div class="space-y-2">
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_sitemap" value="1" {{ $settings['seo']['enable_sitemap'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Enable XML Sitemap</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_robots_txt" value="1" {{ $settings['seo']['enable_robots_txt'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Enable robots.txt</span>
                                </label>
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
                                <input type="url" name="facebook_url" value="{{ $settings['social']['facebook_url'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://facebook.com/yourpage">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-twitter text-blue-400 mr-1"></i> Twitter URL
                                </label>
                                <input type="url" name="twitter_url" value="{{ $settings['social']['twitter_url'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://twitter.com/yourhandle">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-instagram text-pink-600 mr-1"></i> Instagram URL
                                </label>
                                <input type="url" name="instagram_url" value="{{ $settings['social']['instagram_url'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://instagram.com/yourhandle">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-linkedin text-blue-700 mr-1"></i> LinkedIn URL
                                </label>
                                <input type="url" name="linkedin_url" value="{{ $settings['social']['linkedin_url'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://linkedin.com/in/yourprofile">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-youtube text-red-600 mr-1"></i> YouTube URL
                                </label>
                                <input type="url" name="youtube_url" value="{{ $settings['social']['youtube_url'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://youtube.com/@yourchannel">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-github text-gray-800 mr-1"></i> GitHub URL
                                </label>
                                <input type="url" name="github_url" value="{{ $settings['social']['github_url'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://github.com/yourusername">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-pinterest text-red-700 mr-1"></i> Pinterest URL
                                </label>
                                <input type="url" name="pinterest_url" value="{{ $settings['social']['pinterest_url'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://pinterest.com/yourhandle">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">
                                    <i class="fa-brands fa-tiktok text-black mr-1"></i> TikTok URL
                                </label>
                                <input type="url" name="tiktok_url" value="{{ $settings['social']['tiktok_url'] }}"
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
                                    <option value="smtp" {{ $settings['email']['mail_driver'] == 'smtp' ? 'selected' : '' }}>
                                        SMTP</option>
                                    <option value="mailgun" {{ $settings['email']['mail_driver'] == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                    <option value="ses" {{ $settings['email']['mail_driver'] == 'ses' ? 'selected' : '' }}>SES
                                    </option>
                                    <option value="sendmail" {{ $settings['email']['mail_driver'] == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Host</label>
                                <input type="text" name="mail_host" value="{{ $settings['email']['mail_host'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="smtp.mailtrap.io">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Port</label>
                                <input type="number" name="mail_port" value="{{ $settings['email']['mail_port'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="587">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Username</label>
                                <input type="text" name="mail_username" value="{{ $settings['email']['mail_username'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Password</label>
                                <input type="password" name="mail_password"
                                    value="{{ $settings['email']['mail_password'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Mail Encryption</label>
                                <select name="mail_encryption"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="tls" {{ $settings['email']['mail_encryption'] == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ $settings['email']['mail_encryption'] == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="" {{ $settings['email']['mail_encryption'] == '' ? 'selected' : '' }}>None
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">From Address</label>
                                <input type="email" name="mail_from_address"
                                    value="{{ $settings['email']['mail_from_address'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">From Name</label>
                                <input type="text" name="mail_from_name" value="{{ $settings['email']['mail_from_name'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div class="md:col-span-2">
                                <button type="button" onclick="testEmail()"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    <i class="fa-solid fa-paper-plane mr-2"></i> Send Test Email
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Tab -->
                    <div x-show="tab === 'comments'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Comment Settings</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_comments" value="1" {{ $settings['comments']['enable_comments'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Enable Comments</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Comment Approval</label>
                                <select name="comments_approval"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="automatic" {{ $settings['comments']['comments_approval'] == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                    <option value="manual" {{ $settings['comments']['comments_approval'] == 'manual' ? 'selected' : '' }}>Manual Approval</option>
                                </select>
                            </div>

                            <div>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="allow_guest_comments" value="1" {{ $settings['comments']['allow_guest_comments'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Allow Guest Comments</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Comments Per Page</label>
                                <input type="number" name="comments_per_page"
                                    value="{{ $settings['comments']['comments_per_page'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    min="10" max="200">
                            </div>

                            <div>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_nested_comments" value="1" {{ $settings['comments']['enable_nested_comments'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Enable Nested Comments</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Max Nesting Level</label>
                                <input type="number" name="max_nesting_level"
                                    value="{{ $settings['comments']['max_nesting_level'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    min="1" max="10">
                            </div>

                            <div>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_likes" value="1" {{ $settings['comments']['enable_likes'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Enable Likes on Comments</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div x-show="tab === 'security'" x-cloak>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Security Settings</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_captcha" value="1" {{ $settings['security']['enable_captcha'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Enable CAPTCHA on Forms</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">reCAPTCHA Site Key</label>
                                <input type="text" name="captcha_site_key"
                                    value="{{ $settings['security']['captcha_site_key'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">reCAPTCHA Secret Key</label>
                                <input type="password" name="captcha_secret_key"
                                    value="{{ $settings['security']['captcha_secret_key'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_ssl" value="1" {{ $settings['security']['enable_ssl'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Force SSL/HTTPS</span>
                                </label>
                            </div>

                            <div>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="enable_maintenance" value="1" {{ $settings['security']['enable_maintenance'] ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-gray-700 text-sm">Enable Maintenance Mode</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Maintenance Message</label>
                                <textarea name="maintenance_message" rows="2"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $settings['security']['maintenance_message'] }}</textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Allowed IPs (comma
                                    separated)</label>
                                <input type="text" name="allowed_ips" value="{{ $settings['security']['allowed_ips'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="127.0.0.1, 192.168.1.1">
                            </div>
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
        <!-- Settings Tabs -->

    </div>

    <!-- Test Email Script -->
    <script>
      
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-admin-layout>