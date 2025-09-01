document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("nav-toggle");
  const navbar = document.querySelector(".navbar");

  toggle.addEventListener("click", () => {
    navbar.classList.toggle("hidden");
    const icon = toggle.querySelector("i");
    if (navbar.classList.contains("hidden")) {
      icon.classList.remove("fa-chevron-up");
      icon.classList.add("fa-chevron-down");
    } else {
      icon.classList.remove("fa-chevron-down");
      icon.classList.add("fa-chevron-up");
    }
  });
});
document.addEventListener("DOMContentLoaded", () => {
  const projectList = document.getElementById("project-list");

  fetch("get_projects.php")
    .then(response => response.json())
    .then(data => {
        const table = document.createElement("table");
        table.classList.add("projects-table");

        table.innerHTML = `
          <tr>
            <th>Index</th>
            <th>Project Name</th>
            <th>Description</th>
            <th>Link</th>
          </tr>
        `;

        data.forEach((projects, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
              <td>${index+1}</td>
              <td>${projects.name}</td>
              <td>${projects.description}</td>
              <td><a href="${projects.link}" target="_blank"><i class="fas fa-link"></i></td>
            `;
            table.appendChild(row);
        });

        projectList.appendChild(table);
    })
    .catch(err => console.error("Error loading projects:", err));
});
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("year").textContent = new Date().getFullYear();
});

