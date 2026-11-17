import { supabase, configured } from "./supabase-client.js";
const loginUrl = "login.html";
if (!configured) {
  window.location.replace(loginUrl + "?setup=1");
} else {
  try {
    const { data, error } = await supabase.auth.getUser();
    if (error || !data.user) {
      window.location.replace(loginUrl);
    } else {
      document.getElementById("accountEmail").textContent = data.user.email || "Signed in";
      document.body.classList.remove("auth-pending");
      document.getElementById("logoutButton").addEventListener("click", async () => {
        const { error } = await supabase.auth.signOut();
        if (error) alert(error.message);
        else window.location.replace(loginUrl);
      });
    }
  } catch (e) {
    window.location.replace(loginUrl + "?error=connection");
  }
}
