// Navbar scroll efect
window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("shrink");
  } else {
    navbar.classList.remove("shrink");
  }
});

// Counter Animation for Stats
function animateCounter(element, target) {
  let current = 0;
  const increment = target / 100;
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    element.textContent = Math.floor(current) + "+";
  }, 20);
}

// Animate counters when stats section is visible
const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const numbers = entry.target.querySelectorAll(".stat-number");
      numbers.forEach((num) => {
        const target = parseInt(num.textContent);
        animateCounter(num, target);
      });
      statsObserver.unobserve(entry.target);
    }
  });
});

// Start observing the stats section
const statsSection = document.querySelector(".stats");
if (statsSection) {
  statsObserver.observe(statsSection);
}

// ... existing code ...
function toggleAnimatedSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section.classList.contains("show")) {
    section.classList.remove("show");
    setTimeout(() => {
      section.style.display = "none";
    }, 400); // match transition duration
  } else {
    section.style.display = "flex";
    setTimeout(() => {
      section.classList.add("show");
    }, 10); // allow display to apply before animating
  }
}

function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("active");
    document.getElementById("sidebar-overlay").classList.toggle("active");
    document.body.classList.toggle("sidebar-open");
}

function closeSidebar() {
    document.getElementById("sidebar").classList.remove("active");
    document.getElementById("sidebar-overlay").classList.remove("active");
    document.body.classList.remove("sidebar-open");
}


