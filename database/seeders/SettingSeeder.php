<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_settings')->insert(
            [
                [
                    'name'  => 'menu_locations',
                    'val'   => '{"primary":1}',
                    'group' => "general",
                ],
                [
                    'name'  => 'admin_email',
                    'val'   => 'contact@bookingcore.test',
                    'group' => "general",
                ], [
                    'name'  => 'email_from_name',
                    'val'   => 'To Mongolia',
                    'group' => "general",
                ], [
                    'name'  => 'email_from_address',
                    'val'   => 'contact@bookingcore.test',
                    'group' => "general",
                ],
                [
                    'name'  => 'logo_id',
                    'val'   => MediaFile::findMediaByName("logo")->id,
                    'group' => "general",
                ],
                [
                    'name'  => 'site_favicon',
                    'val'   => MediaFile::findMediaByName("favicon")->id,
                    'group' => "general",
                ],
                [
                    'name'  => 'topbar_left_text',
                    'val'   => '<div class="socials">
                    <a href="#"><i class="fa fa-kakao"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <span class="line"></span>
                    <a href="mailto:contact@bookingcore.test">contact@bookingcore.test</a>',
                    'group' => "general",
                ],
                [
                    'name'  => 'footer_text_left',
                    'val'   => '© 2022 Gcomm, Inc. 판권 소유.',
                    'group' => "general",
                ],
                [
                    'name'  => 'footer_text_right',
                    'val'   => '',
                    'group' => "general",
                ],
                [
                    'name'  => 'list_widget_footer',
                    'val'   => '[{"title":"NEED HELP?","size":"3","content":"<div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Call Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            + 00 222 44 5678\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Email for Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            info@gcommunication.mn\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Follow Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            <a href=\"#\">\r\n                <i class=\"icofont-facebook\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n               <i class=\"icofont-twitter\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-youtube-play\"><\/i>\r\n            <\/a>\r\n        <\/div>\r\n    <\/div>"},{"title":"COMPANY","size":"3","content":"<ul>\r\n    <li><a href=\"#\">About Us<\/a><\/li>\r\n    <li><a href=\"#\">Community Blog<\/a><\/li>\r\n    <li><a href=\"#\">Rewards<\/a><\/li>\r\n    <li><a href=\"#\">Work with Us<\/a><\/li>\r\n    <li><a href=\"#\">Meet the Team<\/a><\/li>\r\n<\/ul>"},{"title":"SUPPORT","size":"3","content":"<ul>\r\n    <li><a href=\"#\">Account<\/a><\/li>\r\n    <li><a href=\"#\">Legal<\/a><\/li>\r\n    <li><a href=\"#\">Contact<\/a><\/li>\r\n    <li><a href=\"#\">Affiliate Program<\/a><\/li>\r\n    <li><a href=\"#\">Privacy Policy<\/a><\/li>\r\n<\/ul>"},{"title":"SETTINGS","size":"3","content":"<ul>\r\n<li><a href=\"#\">Setting 1<\/a><\/li>\r\n<li><a href=\"#\">Setting 2<\/a><\/li>\r\n<\/ul>"}]',
                    'group' => "general",
                ],
                [
                    'name'  => 'list_widget_footer_ja',
                    'val'   => '[{"title":"\u52a9\u3051\u304c\u5fc5\u8981\uff1f","size":"3","content":"<div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u304a\u96fb\u8a71\u304f\u3060\u3055\u3044\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            + 00 222 44 5678\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u90f5\u4fbf\u7269\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            info@gcommunication.mn\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u30d5\u30a9\u30ed\u30fc\u3059\u308b\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            <a href=\"#\">\r\n                <i class=\"icofont-facebook\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-twitter\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-youtube-play\"><\/i>\r\n            <\/a>\r\n        <\/div>\r\n    <\/div>"},{"title":"\u4f1a\u793e","size":"3","content":"<ul>\r\n    <li><a href=\"#\">\u7d04, \u7565<\/a><\/li>\r\n    <li><a href=\"#\">\u30b3\u30df\u30e5\u30cb\u30c6\u30a3\u30d6\u30ed\u30b0<\/a><\/li>\r\n    <li><a href=\"#\">\u5831\u916c<\/a><\/li>\r\n    <li><a href=\"#\">\u3068\u9023\u643a<\/a><\/li>\r\n    <li><a href=\"#\">\u30c1\u30fc\u30e0\u306b\u4f1a\u3046<\/a><\/li>\r\n<\/ul>"},{"title":"\u30b5\u30dd\u30fc\u30c8","size":"3","content":"<ul>\r\n    <li><a href=\"#\">\u30a2\u30ab\u30a6\u30f3\u30c8<\/a><\/li>\r\n    <li><a href=\"#\">\u6cd5\u7684<\/a><\/li>\r\n    <li><a href=\"#\">\u63a5\u89e6<\/a><\/li>\r\n    <li><a href=\"#\">\u30a2\u30d5\u30a3\u30ea\u30a8\u30a4\u30c8\u30d7\u30ed\u30b0\u30e9\u30e0<\/a><\/li>\r\n    <li><a href=\"#\">\u500b\u4eba\u60c5\u5831\u4fdd\u8b77\u65b9\u91dd<\/a><\/li>\r\n<\/ul>"},{"title":"\u8a2d\u5b9a","size":"3","content":"<ul>\r\n<li><a href=\"#\">\u8a2d\u5b9a1<\/a><\/li>\r\n<li><a href=\"#\">\u8a2d\u5b9a2<\/a><\/li>\r\n<\/ul>"}]',
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_title',
                    'val' => "We'd love to hear from you",
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_sub_title',
                    'val' => "Send us a message and we'll respond as soon as possible",
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_desc',
                    'val' => "<!DOCTYPE html><html><head></head><body><h3>To Mongolia</h3><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Tell. + 00 222 444 33</p><p>Email. info@gcommunication.mn</p><p>1355 Market St, Suite 900San, Francisco, CA 94103 United States</p></body></html>",
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_image',
                    'val' => MediaFile::findMediaByName("bg_contact")->id,
                    'group' => "general",
                ],
                [
                    'name' => 'api_app_layout',
                    'val' => "1",
                    'group' => "api",
                ],
                [
                    'name' => 'playstore_link',
                    'val' => "https://play.google.com/store/apps/details?id=com.to.mongolia",
                    'group' => "api",
                ],
                [
                    'name' => 'appstore_link',
                    'val' => "https://play.google.com/store/apps/details?id=com.to.mongolia",
                    'group' => "api",
                ],
            ]
        );

        DB::table('core_settings')->insert([
            [
                'name'  => 'home_page_id',
                'val'   => '1',
                'group' => "general",
            ],
            [
                'name'  => 'page_contact_title',
                'val'   => "We'd love to hear from you",
                'group' => "general",
            ],
            [
                'name'  => 'page_contact_title_ja',
                'val'   => "あなたからの御一報をお待ち",
                'group' => "general",
            ],
            [
                'name'  => 'page_contact_sub_title',
                'val'   => "Send us a message and we'll respond as soon as possible",
                'group' => "general",
            ],
            [
                'name'  => 'page_contact_sub_title_ja',
                'val'   => "私たちにメッセージを送ってください、私たちはできるだ",
                'group' => "general",
            ],
            [
                'name'  => 'page_contact_desc',
                'val'   => "<!DOCTYPE html><html><head></head><body><h3>To Mongolia</h3><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Tell. + 00 222 444 33</p><p>Email. info@gcommunication.mn</p><p>1355 Market St, Suite 900San, Francisco, CA 94103 United States</p></body></html>",
                'group' => "general",
            ],
            [
                'name'  => 'page_contact_image',
                'val'   => MediaFile::findMediaByName("bg_contact")->id,
                'group' => "general",
            ]
        ]);

        // Setting Currency
        DB::table('core_settings')->insert([
            [
                'name'  => "currency_main",
                'val'   => "usd",
                'group' => "payment",
            ],
            [
                'name'  => "currency_format",
                'val'   => "left",
                'group' => "payment",
            ],
            [
                'name'  => "currency_decimal",
                'val'   => ",",
                'group' => "payment",
            ],
            [
                'name'  => "currency_thousand",
                'val'   => ".",
                'group' => "payment",
            ],
            [
                'name'  => "currency_no_decimal",
                'val'   => "0",
                'group' => "payment",
            ],
            [
                'name'  => "extra_currency",
                'val'   => '[{"currency_main":"KRW","currency_format":"right_space","currency_thousand":".","currency_decimal":",","currency_no_decimal":"0","rate":"0.00917113"}]',
                'group' => "payment",
            ]
        ]);

        // MAP
        DB::table('core_settings')->insert([
            [
                'name'  => 'map_provider',
                'val'   => 'gmap',
                'group' => "advance",
            ],
            [
                'name'  => 'map_gmap_key',
                'val'   => 'AIzaSyCAnoyPXEuXxXlSM5c-9zlaKkf_jjXWFVM',
                'group' => "advance",
            ],
            [
                'name'  => 'map_lat_default',
                'val'   => '47.918966',
                'group' => "advance",
            ],
            [
                'name'  => 'map_lng_default',
                'val'   => '106.917771',
                'group' => "advance",
            ],
            [
                'name'  => 'facebook_enable',
                'val'   => '1',
                'group' => "advance",
            ],
            [
                'name'  => 'facebook_client_id',
                'val'   => '703802455088477',
                'group' => "advance",
            ],
            [
                'name'  => 'facebook_client_secret',
                'val'   => 'f1e2422c7847b9d050fcbdf46f923aba',
                'group' => "advance",
            ],
            [
                'name'  => 'google_enable',
                'val'   => '1',
                'group' => "advance",
            ],
            [
                'name'  => 'google_client_id',
                'val'   => '966138622760-tqbl3868vr54q5kagb23vm8od53bs9q9.apps.googleusercontent.com',
                'group' => "advance",
            ],
            [
                'name'  => 'google_client_secret',
                'val'   => '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',
                'group' => "advance",
            ],
            [
                'name'  => 'kakao_enable',
                'val'   => '1',
                'group' => "advance",
            ],
            [
                'name'  => 'kakao_client_id',
                'val'   => '853155',
                'group' => "advance",
            ],
            [
                'name'  => 'kakao_client_secret',
                'val'   => 'VJzvyOsqQ3sBK8Xq4fz7MnsAByqjQbrF',
                'group' => "advance",
            ],
        ]);

        // Payment Gateways
        DB::table('core_settings')->insert([
            [
                'name'  => "g_offline_payment_enable",
                'val'   => "1",
                'group' => "payment",
            ],
            [
                'name'  => "g_offline_payment_name",
                'val'   => "Offline Payment",
                'group' => "payment",
            ]
        ]);

        // Settings general
        DB::table('core_settings')->insert([
            [
                'name'  => "date_format",
                'val'   => "m/d/Y",
                'group' => "general",
            ],
            [
                'name'  => "site_title",
                'val'   => "To Mongolia",
                'group' => "general",
            ],
        ]);

        // Email general
        DB::table('core_settings')->insert([
            [
                'name'  => "site_timezone",
                'val'   => "UTC",
                'group' => "general",
            ],
            [
                'name'  => "site_title",
                'val'   => "To Mongolia",
                'group' => "general",
            ],
            [
                'name'  => "email_header",
                'val'   => '<h1 class="site-title" style="text-align: center">To Mongolia</h1>',
                'group' => "general",
            ],
            [
                'name'  => "email_footer",
                'val'   => '<p class="" style="text-align: center">&copy; 2023 To Mongolia. All rights reserved</p>',
                'group' => "general",
            ],
            [
                'name'  => "enable_mail_user_registered",
                'val'   => 1,
                'group' => "user",
            ],
            [
                'name'  => "user_content_email_registered",
                'val'   => '<h1 style="text-align: center">Welcome!</h1>
                <h3>Hello [first_name] [last_name]</h3>
                <p>Thank you for signing up with To Mongolia! We hope you enjoy your time with us.</p>
                <p>Regards,</p>
                <p>To Mongolia</p>',
                'group' => "user",
            ],
            [
                'name'  => "admin_enable_mail_user_registered",
                'val'   => 1,
                'group' => "user",
            ],
            [
                'name'  => "admin_content_email_user_registered",
                'val'   => '<h3>Hello Administrator</h3>
                <p>We have new registration</p>
                <p>Full name: [first_name] [last_name]</p>
                <p>Email: [email]</p>
                <p>Regards,</p>
                <p>To Mongolia</p>',
                'group' => "user",
            ],
            [
                'name'  => "user_content_email_forget_password",
                'val'   => '<h1>Hello!</h1>
                <p>You are receiving this email because we received a password reset request for your account.</p>
                <p style="text-align: center">[button_reset_password]</p>
                <p>This password reset link expire in 60 minutes.</p>
                <p>If you did not request a password reset, no further action is required.
                </p>
                <p>Regards,</p>
                <p>To Mongolia</p>',
                'group' => "user",
            ]
        ]);

        // Email Setting
        DB::table('core_settings')->insert([
            [
                'name'  => "email_driver",
                'val'   => "log",
                'group' => "email",
            ],
            [
                'name'  => "email_host",
                'val'   => "smtp.mailgun.org",
                'group' => "email",
            ],
            [
                'name'  => "email_port",
                'val'   => "587",
                'group' => "email",
            ],
            [
                'name'  => "email_encryption",
                'val'   => "tls",
                'group' => "email",
            ],
            [
                'name'  => "email_username",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "email_password",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "email_mailgun_domain",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "email_mailgun_secret",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "email_mailgun_endpoint",
                'val'   => "api.mailgun.net",
                'group' => "email",
            ],
            [
                'name'  => "email_postmark_token",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "email_ses_key",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "email_ses_secret",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "email_ses_region",
                'val'   => "us-east-1",
                'group' => "email",
            ],
            [
                'name'  => "email_sparkpost_secret",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "enable_mailchimp",
                'val'   => "0",
                'group' => "email",
            ],
            [
                'name'  => "mailchimp_api_key",
                'val'   => "",
                'group' => "email",
            ],
            [
                'name'  => "mailchimp_list_id",
                'val'   => "",
                'group' => "email",
            ],
        ]);

        // Email Setting
        DB::table('core_settings')->insert([
            [
                'name'  => "booking_enquiry_for_hotel",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_hotel",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_tour",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_tour",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_community",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_community",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_space",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_space",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_car",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_car",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_event",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_event",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_boat",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_boat",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_enable_mail_to_vendor",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_mail_to_vendor_content",
                'val'   => "<h3>Hello [vendor_name]</h3>
                            <p>You get new inquiry request from [email]</p>
                            <p>Name :[name]</p>
                            <p>Emai:[email]</p>
                            <p>Phone:[phone]</p>
                            <p>Content:[note]</p>
                            <p>Service:[service_link]</p>
                            <p>Regards,</p>
                            <p>To Mongolia</p>
                            </div>",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_enable_mail_to_admin",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_mail_to_admin_content",
                'val'   => "<h3>Hello Administrator</h3>
                            <p>You get new inquiry request from [email]</p>
                            <p>Name :[name]</p>
                            <p>Emai:[email]</p>
                            <p>Phone:[phone]</p>
                            <p>Content:[note]</p>
                            <p>Service:[service_link]</p>
                            <p>Vendor:[vendor_link]</p>
                            <p>Regards,</p>
                            <p>To Mongolia</p>",
                'group' => "enquiry",
            ],
        ]);

        // Vendor setting
        DB::table('core_settings')->insert([
            [
                'name'  => "vendor_enable",
                'val'   => "1",
                'group' => "vendor",
            ],
            [
                'name'  => "vendor_commission_type",
                'val'   => "percent",
                'group' => "vendor",
            ],
            [
                'name'  => "vendor_commission_amount",
                'val'   => "10",
                'group' => "vendor",
            ],
            [
                'name'  => "vendor_role",
                'val'   => "1",
                'group' => "vendor",
            ],
            [
                'name'  => "role_verify_fields",
                'val'   => '{"phone":{"name":"Phone","type":"text","roles":["1","2","3"],"required":null,"order":null,"icon":"fa fa-phone"},"id_card":{"name":"ID Card","type":"file","roles":["1","2","3"],"required":"1","order":"0","icon":"fa fa-id-card"},"trade_license":{"name":"Trade License","type":"multi_files","roles":["1","3"],"required":"1","order":"0","icon":"fa fa-copyright"}}',
                'group' => "vendor",
            ],
            [
                'name'  => "vendor_show_email",
                'val'   => "1",
                'group' => "vendor",
            ],
            [
                'name'  => "vendor_show_phone",
                'val'   => "1",
                'group' => "vendor",
            ],
        ]);

        DB::table('core_settings')->insert([
            'name'  => 'enable_mail_vendor_registered',
            'val'   => '1',
            'group' => 'vendor'
        ]);

        DB::table('core_settings')->insert([
            'name'  => 'vendor_content_email_registered',
            'val'   => '<h1 style="text-align: center;">Welcome!</h1>
                        <h3>Hello [first_name] [last_name]</h3>
                        <p>Thank you for signing up with To Mongolia! We hope you enjoy your time with us.</p>
                        <p>Regards,</p>
                        <p>To Mongolia</p>',
            'group' => 'vendor'
        ]);

        DB::table('core_settings')->insert([
            'name'  => 'admin_enable_mail_vendor_registered',
            'val'   => '1',
            'group' => 'vendor'
        ]);

        DB::table('core_settings')->insert([
            'name'  => 'admin_content_email_vendor_registered',
            'val'   => '<h3>Hello Administrator</h3>
                        <p>An user has been registered as Vendor. Please check the information bellow:</p>
                        <p>Full name: [first_name] [last_name]</p>
                        <p>Email: [email]</p>
                        <p>Registration date: [created_at]</p>
                        <p>You can approved the request here: [link_approved]</p>
                        <p>Regards,</p>
                        <p>To Mongolia</p>',
            'group' => 'vendor'
        ]);

        // Cookie agreement
        DB::table('core_settings')->insert([
            [
                'name'  => "cookie_agreement_enable",
                'val'   => "1",
                'group' => "advance",
            ],
            [
                'name'  => "cookie_agreement_button_text",
                'val'   => "Got it",
                'group' => "advance",
            ],
            [
                'name'  => "cookie_agreement_content",
                'val'   => "<p>This website requires cookies to provide all of its features. By using our website, you agree to our use of cookies. <a href='#'>More info</a></p>",
                'group' => "advance",
            ],
        ]);

        // Invoice setting
        DB::table('core_settings')->insert([
            [
                'name'  => 'logo_invoice_id',
                'val'   => MediaFile::findMediaByName("logo")->id,
                'group' => "booking",
            ],
            [
                'name'  => "invoice_company_info",
                'val'   => "<p><span style=\"font-size: 14pt;\"><strong>To Mongolia Company</strong></span></p>
                            <p>Ha Noi, Viet Nam</p>
                            <p>www.bookingcore.org</p>",
                'group' => "booking",
            ],
        ]);

        setting_update_item('user_role',2);
        setting_update_item('vendor_team_enable',1);
        setting_update_item('user_plans_enable',0);
    }
}
