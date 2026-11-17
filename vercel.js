{
  "$schema": "https://openapi.vercel.sh/vercel.json",
  "functions": {
    "api/*.php": {
      "runtime": "vercel-php@0.9.0"
    }
  },
  "rewrites": [
    {
      "source": "/bible.php",
      "destination": "/api/bible.php"
    },
    {
      "source": "/chapters.php",
      "destination": "/sapi/chapters.php"
    },
    {
      "source": "/verse.php",
      "destination": "/api/verse.php"
    }
  ]
}