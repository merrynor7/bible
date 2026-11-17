import { supabase, configured } from "./supabase-client.js";
const form = document.getElementById("authForm");
const message = document.getElementById("authMessage");
const mode = document.body.dataset.mode;
function status(text, error=false) { message.textContent=text; message.classList.toggle("error", error); }
if (!configured) status("Setup needed: add your Supabase URL and publishable key in supabase-config.js.", true);
else {
  const {data}=await supabase.auth.getUser();
  if (data.user) window.location.replace("index.html");
}
form.addEventListener("submit", async e => {
  e.preventDefault();
  if (!configured) return status("Configure Supabase first.", true);
  const email=document.getElementById("email").value.trim();
  const password=document.getElementById("password").value;
  if (!email || password.length < 6) return status("Enter a valid email and a password with at least 6 characters.", true);
  const button=form.querySelector("button[type=submit]");
  button.disabled=true; status(mode==="register"?"Creating account...":"Signing in...");
  try {
    const { data, error } = mode==="register"
      ? await supabase.auth.signUp({email,password})
      : await supabase.auth.signInWithPassword({email,password});
    if (error) throw error;
    if (mode==="register" && !data.session) status("Check your email to confirm your account, then log in.");
    else window.location.replace("index.html");
  } catch(err) { status(err.message || "Authentication failed.",true); }
  finally { button.disabled=false; }
});
