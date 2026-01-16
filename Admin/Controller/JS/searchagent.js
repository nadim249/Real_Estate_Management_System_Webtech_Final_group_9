

document.getElementById("searchInput").addEventListener("keyup", function () {
    const query = this.value;

    const xhr = new XMLHttpRequest();
    // Path is relative to the page URL (users.php in View/AdminDash)
    xhr.open("POST", "../../Controller/searchAgents.php", true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status === 200) {
            const tbody = document.getElementById("tableBody");
            if (tbody) tbody.innerHTML = this.responseText;
        }
    };

    xhr.send("query=" + encodeURIComponent(query));
});