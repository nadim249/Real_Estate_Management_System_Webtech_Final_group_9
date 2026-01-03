/* ========= DATA (idea taken from user.html) ========= */
const properties = [
  {
    id: 1,
    title: "Modern Villa",
    price: "450,000,000 BDT",
    type: "Sale",
    location: "Gulshan 2, Dhaka",
    img: "https://images.unsplash.com/photo-1564013799919-ab600027ffc6?q=80&w=1200&auto=format&fit=crop",
    beds: 5,
    baths: 5,
    sqft: 4000
  },
  {
    id: 2,
    title: "City Apartment",
    price: "200,000 BDT/mo",
    type: "Rent",
    location: "Banani, Dhaka",
    img: "https://images.unsplash.com/photo-1505691938895-1758d7feb511?q=80&w=1200&auto=format&fit=crop",
    beds: 3,
    baths: 2,
    sqft: 1200
  },
  {
    id: 3,
    title: "Modern Family Home",
    price: "50,200,000 BDT",
    type: "Sale",
    location: "Bashundhara R/A, Dhaka",
    img: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200&auto=format&fit=crop",
    beds: 4,
    baths: 3,
    sqft: 2500
  },
  {
    id: 4,
    title: "Luxury Penthouse",
    price: "200,500,000 BDT",
    type: "Sale",
    location: "Dhanmondi, Dhaka",
    img: "https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?q=80&w=1200&auto=format&fit=crop",
    beds: 4,
    baths: 4,
    sqft: 2800
  }
];

/* ========= HELPERS ========= */
function $(sel) { return document.querySelector(sel); }
function getQueryParam(name) {
  const url = new URL(window.location.href);
  return url.searchParams.get(name);
}

/* ========= 1) ACTIVE NAV LINK ========= */
function setActiveNav() {
  const path = (window.location.pathname || "").toLowerCase();

  // Works with your page names:
  const map = [
    { file: "nav.html", text: "home" },
    { file: "availableproperties.html", text: "properties" },
    { file: "aboutus.html", text: "about" },
    { file: "contectus.html", text: "contact" }
  ];

  const links = document.querySelectorAll(".nav-center a");
  if (!links.length) return;

  links.forEach(a => a.classList.remove("active"));

  const found = map.find(m => path.includes(m.file));
  if (!found) return;

  links.forEach(a => {
    if (a.textContent.toLowerCase().includes(found.text)) {
      a.classList.add("active");
    }
  });
}

/* ========= 2) RENDER HOME FEATURED CARDS ========= */
function renderFeatured() {
  const wrap = document.getElementById("featured-cards");
  if (!wrap) return;

  // show first 4 items
  const items = properties.slice(0, 4);

  wrap.innerHTML = items.map(p => `
    <div class="p-card" onclick="goDetails(${p.id})">
      <div class="p-img">
        <span class="badge ${p.type === "Sale" ? "sale" : "rent"}">
          For ${p.type}
        </span>
        <img src="${p.img}" alt="${p.title}">
      </div>
      <div class="p-body">
        <div class="p-price">${p.price}</div>
        <div class="p-title">${p.title}</div>
        <div class="p-loc">${p.location}</div>
      </div>
    </div>
  `).join("");
}

/* ========= 3) RENDER ALL PROPERTIES PAGE ========= */
function renderAllProperties() {
  const grid = document.getElementById("all-properties");
  if (!grid) return;

  grid.innerHTML = properties.map(p => `
    <div class="card" onclick="goDetails(${p.id})">
      <div class="img-box">
        <img src="${p.img}" alt="${p.title}" />
        <span class="tag ${p.type === "Sale" ? "tag-blue" : "tag-pink"}">
          ${p.type === "Sale" ? "FOR SALE" : "FOR RENT"}
        </span>
      </div>

      <div class="content">
        <div class="price">${p.price}</div>
        <div class="title">${p.title}</div>
        <div class="location">${p.location}</div>

        <div class="divider"></div>

        <div class="stats">
          <div class="stat">
            <div class="num">${p.beds}</div>
            <div class="lbl">Beds</div>
          </div>
          <div class="stat">
            <div class="num">${p.baths}</div>
            <div class="lbl">Baths</div>
          </div>
          <div class="stat">
            <div class="num">${p.sqft}</div>
            <div class="lbl">Sqft</div>
          </div>
        </div>

        <button class="btn" type="button">View Details</button>
      </div>
    </div>
  `).join("");
}

/* ========= 4) OPEN DETAILS PAGE ========= */
function goDetails(id) {
  // send id to ViewDetails page using query string
  window.location.href = `ViewDetails.html?id=${id}`;
}
window.goDetails = goDetails; // important for onclick in HTML string

function loadDetailsPage() {
  const id = Number(getQueryParam("id"));
  if (!id) return;

  const p = properties.find(x => x.id === id);
  if (!p) return;

  const titleEl = document.getElementById("detail-title");
  const addrEl  = document.getElementById("detail-addr");
  const imgEl   = document.getElementById("detail-img");
  const priceEl = document.getElementById("detail-price");

  if (titleEl) titleEl.textContent = p.title;
  if (addrEl)  addrEl.textContent = p.location;
  if (imgEl)   imgEl.src = p.img;
  if (priceEl) priceEl.textContent = p.price;
}

/* ========= 5) BUY / RENT TAB (HOME) ========= */
function setupTabs() {
  const tabs = document.querySelectorAll(".tab");
  if (!tabs.length) return;

  tabs.forEach(t => {
    t.addEventListener("click", () => {
      tabs.forEach(x => x.classList.remove("active"));
      t.classList.add("active");
    });
  });
}

/* ========= 6) BASIC LOGIN STATE (optional) =========
   (Idea from user.html: logged-in state changes nav)
*/
function setUserUI() {
  // optional elements (if you add them later)
  const loginLink = document.querySelector(".login");
  const signupLink = document.querySelector(".signup");

  const user = JSON.parse(localStorage.getItem("user") || "null");

  if (user && loginLink && signupLink) {
    loginLink.textContent = `Hi, ${user.name.split(" ")[0]}`;
    signupLink.textContent = "Log Out";
    signupLink.href = "#";
    signupLink.addEventListener("click", (e) => {
      e.preventDefault();
      localStorage.removeItem("user");
      window.location.href = "Nav.html";
    });
  }
}

/* ========= 7) HANDLE LOGIN/SIGNUP FORMS ========= */
function setupAuthForms() {
  // Login page
  const loginForm = document.querySelector("form.form");
  const pageTitle = document.querySelector("h1.title");

  if (!loginForm || !pageTitle) return;

  const title = pageTitle.textContent.toLowerCase();

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (title.includes("log in")) {
      // fake login
      localStorage.setItem("user", JSON.stringify({ name: "User", email: "demo@mail.com" }));
      window.location.href = "Nav.html";
    }

    if (title.includes("sign up")) {
      // fake signup
      const nameInput = document.getElementById("name");
      const emailInput = document.getElementById("email");

      const name = nameInput ? nameInput.value.trim() : "User";
      const email = emailInput ? emailInput.value.trim() : "demo@mail.com";

      localStorage.setItem("user", JSON.stringify({ name, email }));
      window.location.href = "Nav.html";
    }
  });
}

/* ========= RUN EVERYTHING ========= */
document.addEventListener("DOMContentLoaded", () => {
  setActiveNav();
  renderFeatured();
  renderAllProperties();
  loadDetailsPage();
  setupTabs();
  setUserUI();
  setupAuthForms();
});
