MYBIBLE — LOGIN FIRST (Supabase Auth)

1. Create a project in https://supabase.com/dashboard
2. Under Project Settings / API keys, copy your Project URL and publishable key into supabase-config.js (never use secret/service-role keys).
3. In Authentication > Providers, enable Email. Default email confirmation may require checking your inbox.
4. In Authentication > URL Configuration set Site URL to http://localhost/bible/ for local testing and add your eventual Vercel URL to allowed redirects.
5. Place all files in C:\xampp\htdocs\bible\, start Apache, and open http://localhost/bible/login.html.
6. Register, confirm email if required, and log in.
7. Existing bible.php, chapters.php and verse.php are unchanged.

SECURITY / DEPLOYMENT NOTES:
- This is a frontend login gate for the HTML dashboard, not backend authorization on the PHP pages. The three unchanged PHP endpoints remain publicly accessible. Any future personal user data must use RLS-secured Supabase tables.
- Vercel does not run PHP natively; for production deploy, the Bible API PHP functions need a separate PHP host or migration to JavaScript/API routes. This login frontend itself is compatible with static hosting.
- Internet is required for Supabase and Bible API access.
